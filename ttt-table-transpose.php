/**
 * Z Table Transpose - JavaScript
 * 功能名称: Z Table Transpose
 * 版本: 1.2.0
 * 创建日期: 2026-04-13
 * 描述: 响应式表格转置，移动端将横向多列表格自动转为纵向两列布局
 *       仅对父容器带有 .ztranspose 类的表格生效
 * 修改记录:
 *   v1.0.0 - 2026-04-13 - 初始版本
 *   v1.1.0 - 2026-04-13 - 改为按 .ztranspose 标记类触发，避免影响全部表格
 *   v1.2.0 - 2026-04-13 - 改为检测父容器的 .ztranspose 类，而非表格本身
 */

add_action( 'wp_footer', function () {
    ?>
    <script id="ztable-transpose-script">
    (function () {
        'use strict';

        /**
         * 初始化单个 ZTableTranspose 实例
         * @param {HTMLElement} table - 目标 table 元素
         */
        function ZTableTransposeInit(table) {

            // 保存原始 HTML，用于恢复 PC 布局
            table.dataset.originalHtml = table.innerHTML;

            function transpose() {
                const isMobile = window.innerWidth <= 768;

                if (isMobile && table.dataset.transposed === 'true') return;
                if (!isMobile && table.dataset.transposed !== 'true') return;

                if (isMobile) {
                    const thead = table.querySelector('thead');
                    const tbody = table.querySelector('tbody');
                    const headerCells = [...thead.querySelectorAll('th')];
                    const dataCells  = [...tbody.querySelector('tr').querySelectorAll('td')];

                    thead.innerHTML = '';
                    tbody.innerHTML = '';

                    headerCells.forEach(function (th, i) {
                        const newRow = document.createElement('tr');
                        newRow.className = 'row-' + (i + 1);

                        const newTh = document.createElement('th');
                        newTh.className = 'column-1';
                        newTh.innerHTML = th.innerHTML;

                        const newTd = document.createElement('td');
                        newTd.className = 'column-2';
                        newTd.innerHTML = dataCells[i] ? dataCells[i].innerHTML : '';

                        newRow.appendChild(newTh);
                        newRow.appendChild(newTd);
                        tbody.appendChild(newRow);
                    });

                    table.dataset.transposed = 'true';

                } else {
                    table.innerHTML = table.dataset.originalHtml;
                    table.dataset.transposed = 'false';
                }
            }

            // 初始执行
            transpose();

            // 监听窗口尺寸变化
            window.addEventListener('resize', transpose);
        }

        /**
         * 页面加载后，查找所有 .ztranspose 容器内的表格并初始化
         */
        document.addEventListener('DOMContentLoaded', function () {
            const tables = document.querySelectorAll('.ztranspose table');
            tables.forEach(function (table) {
                ZTableTransposeInit(table);
            });
        });

    })();
    </script>
    <?php
} );