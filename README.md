### Poker Timer App v0.1

## Description

A simple JavaScript based Poker Timer and League Table updater application.
Under construction.

## Dependencies

The App is built using Bootstrap 4.3.1 with SASS.

## Working with SASS

- Bootstrap source files are in node_modules/bootstrap/scss there is no need to overwrite these unless you are updating Bootstrap
- All custom variables and overwriting Bootstrap variables should be carried out in src/sass/theme/\_myVariables.scss
- All custom SASS styling should be carried out in src/sass/theme/\_myTheme.scss
- Ensure your Visual Code Studio Workspace Settings for Live Sass Compiler are set as follows:
  "settings" {
  "liveSassCompile.settings.formats": [
  {
  "format": "compressed",
  "extensionName": ".min.css",
  "savePath": "/src/css"
  }
  ]
  }
