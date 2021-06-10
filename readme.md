# Med4Care Algolia Integration Project v2.3.0

## Introduction

> This project was created to ensure that _good things_ comes out of [**Algolia**](http://algolia.com/)

## Git Workflow Guidelines
### Branching out
- Before starting to code make sure to create a separate branch
- Checkout `development` branch first, then create a new branch from there
- Branch names must be descriptive and used for specific feature or functionality.
- Branch name: All new branch must be under `feature` branch type; followed by `plugins` or `theme`; lastly, the name of the theme/plugin like `algolia`, lastly, the functionality from you are changing. (i.e. `feature/plugins/algolia_providers`)

### Reusing Branches
- When reusing created branches, make sure your changes are under the functionality of that branch
- General branches like `feature/plugins/algolia` or `feature/theme/oceanwp` are for changes that could affect multiple functionalities (i.e. styles, indices, etc.)

### Committing
- When committing changes, as much as possible list all your changes
- To list all your change you can do the following:
> Multiple changes in algolia
> - Change 1
> - Change 2
> - Change 3
- **Do** commit everyday, but make sure that you are commiting good (partial or complete) code.
- **Do NOT** commit if there errors that might break other functionalities.

### Push & Pull Request (**Before doing this, make sure that you tested your changes**) 
- After commit, push your changes to BitBucket
- Then, create a pull request. Make sure that the source branch (left side) is your own branch, destination branch (right side) is development branch **not master**
- Add a senior developer as a code reviewer and inform the senior that there is an open pull request for them to approve and merge the branches
- If there are conflicts, inform the senior developer. They will be resolving the merging conflict on their end

### Fetch & Pull
- Make it a habit to do a fetch & pull everyday.
- Fetch & Pull after closing a pull request to make your development branch up to date.
- If you recently closed a pull request and make another set of change, checkout development branch and do a fetch & pull. Once development branch is up to date, checkout a `feature` branch. Then on your development branch, do a merge development branch to current branch

## Coding Guidelines

### Plugin

- Reuse current functions if posible
- Insert - all "added" records in Algolia (passing new data to WP)
- Update - all "recently updated" records in Algolia (refresh data to WP)
- **_note: removed from v.1.0.0_** Reindex - all "sync" records in Algolia (refresh back to Algolia)

### PHP & WP

- Use different **layout.php** file per provider type
- Maintain **good coding** habits (like clean & DRY)
- Code in a WordPressy way first, then PHP (i.e. get_template_part vs include or require)

### Stylings

- **v2.0.0:** Created (in-house) JAM3F CSS Framework as a lightweight alternative to Bootstrap (see more on **Using JAM3F section**)
- _\_filename.scss_ as partials
- _filename.scss_ as modules
- use **Block-Element-Modifier** ([BEM](http://getbem.com/)) as naming guidelines (not strict, but recommended)
- **NEVER** use inline or !important to prevent forced styles, unless you are sttuuuuck with global styles or third-party styles (i.e. Bootstrap)

### Using JAM3F

- **Implementation** Create a new folder and copy _app.scss_ and _variables.scss_ from "providers" folder
- **Customization** Fonts and Icons can be customized on app and variables files
- **NPM scripts** If new categories will be using JAM3F, add new scripts in package.json

> **`npm run sass`** runs SASS on watch mode (make sure to perform changes on ALL _\*.scss_ files, not on mapped _\*.css_ files)

> **`npm run sass-prod`** runs SASS on compressed mode for ALL _\*.scss_ files(this will be deployed)

## Installation

1.  Download a platform to run WP [Local by Flywheel](https://localwp.com/) or [XAMPP](https://www.apachefriends.org/index.html)
2.  Install [Node & NPM](https://nodejs.org/en/download/current/)
3.  Get [SASS](https://sass-lang.com/install)
4.  Create a new local WP site
5.  Install \*.zip files of **algolia-custom-integration** plugin and **oceanwp** theme
6.  Activate theme and populate posts with custom data from Algolia
7.  Locate project folder and run _npm run sass_ in your terminal
8.  Drink a cup of coffee and start coding
