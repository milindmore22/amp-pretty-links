# AMP Compatibility Plugin for Pretty Permalink. 

The plugin removes /amp/ endpoint from URL when you choose path suffix as your URL structure.

## Notes

- Plugin useful when path suffix is used.
- Other URL structure will work normally

## Plugin Structure

```markdown
.
├── sanitizers
│   ├── class-sanitizer.php
└── amp-pretty-links.php
```
## Sanitizers

The plugin uses `amp_content_sanitizers` filter to add custom sanitizers, to search for pretty links and remove thier amp endpoints.

### Need a feature in plugin?
Feel free to create a issue, if you still didn't get it to working.