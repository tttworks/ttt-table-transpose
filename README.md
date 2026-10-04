<p align="center">
  <img src="assets/logo.png" alt="TTTWorks" width="260">
</p>

# TTT Table Transpose

**Responsive table transposition for WordPress.**
On narrow viewports, a wide multi-column table becomes a stacked, readable two-column layout.

---

## What it does

- Detects tables inside a parent carrying the `.ztranspose` class and rewrites them for mobile
- **Opt-in by class** — tables you didn't mark are never touched
- Injected through `wp_footer`; no build step, no dependencies, no external requests

---

## Design note

The trigger mechanism took three passes to get right, and the history is in the file header:

| Version | Trigger | Why it changed |
|---|---|---|
| v1.0.0 | all tables | too aggressive — broke unrelated layouts |
| v1.1.0 | the table itself (`.ztranspose` on `<table>`) | better, but you had to edit every table |
| **v1.2.0** | **the parent container** | mark a region once, all its tables follow |

That last step is the one that made it usable in real content.

---

## What this repository is

**Production code, published to show how we build.**

- This is a **snippet**, not an installable plugin. No activation flow, no wp.org release.
- **No installation guide. No support. No portability guarantee.**
- Code assumes a WordPress stack and our own conventions.

---

## License

GPLv2 or later — the same license as WordPress itself.

---

**[TTTWorks](https://tttworks.com)** — Production WordPress engineering.
