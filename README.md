<h1 name="user-content-readme-top">`KanboardGit`</h1>
<p align="center">
    <a href="https://github.com/andrej2431/KanboardGit/releases">
        <img src="https://img.shields.io/github/v/release/andrej2431/KanboardGit?style=for-the-badge&color=brightgreen" alt="GitHub Latest Release (by date)" title="GitHub Latest Release (by date)">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/releases">
        <img src="https://img.shields.io/github/downloads/andrej2431/KanboardGit/total?style=for-the-badge&color=orange" alt="GitHub All Releases" title="GitHub All Downloads">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/releases">
        <img src="https://img.shields.io/github/directory-file-count/andrej2431/KanboardGit?style=for-the-badge&color=orange" alt="GitHub Repository File Count" title="GitHub Repository File Count">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/releases">
        <img src="https://img.shields.io/github/repo-size/andrej2431/KanboardGit?style=for-the-badge&color=orange" alt="GitHub Repository Size" title="GitHub Repository Size">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/releases">
        <img src="https://img.shields.io/github/languages/code-size/andrej2431/KanboardGit?style=for-the-badge&color=orange" alt="GitHub Code Size" title="GitHub Code Size">
    </a>
</p>
<p align="center">
    <a href="https://github.com/andrej2431/KanboardGit/discussions">
        <img src="https://img.shields.io/github/discussions/andrej2431/KanboardGit?style=for-the-badge&color=blue" alt="GitHub Discussions" title="Read Discussions">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/compare">
        <img src="https://img.shields.io/github/commits-since/andrej2431/KanboardGit/latest?include_prereleases&style=for-the-badge&color=blue" alt="GitHub Commits Since Last Release" title="GitHub Commits Since Last Release">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/compare">
        <img src="https://img.shields.io/github/commit-activity/m/andrej2431/KanboardGit?style=for-the-badge&color=blue" alt="GitHub Commit Monthly Activity" title="GitHub Commit Monthly Activity">
    </a>
    <a href="https://github.com/kanboard/kanboard" title="Kanboard - Kanban Project Management Software">
        <img src="https://img.shields.io/badge/Plugin%20for-kanboard-D40000?style=for-the-badge&labelColor=000000" alt="Kanboard">
    </a>
</p>


<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#screenshots">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Features

- `shows commits (message, name, link) in the full task page`
- `jsonrpc api endpoint addCommit for adding a commit`
- `jsonrpc api endpoints canTaskMoveToColumn and moveTaskToColumn for moving task, take task_id and column_title`
- `Pre-receive and Post-receive hooks to be put in repository serverside. (not yet fully finished)`
- `commit message starting with #{task_id} will put the commit under task with that id`
- `commit message that has [column_title] after #{task_id} will move that task under specified column if possible`
- `commits in branches with name {task_id}-... will default to branch task if none is specified`


<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#features">&#8592; Previous</a>] [<a href="#usage">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Screenshots

**Example Task**  

![Example Task](/Assets/example_task.png "Read Screenshot Name")


<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#features">&#8592; Previous</a>] [<a href="#installation--compatibility">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Usage

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#screenshots">&#8592; Previous</a>] [<a href="#authors--contributors">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Installation & Compatibility

<details>
    <summary><strong>Installation</strong></summary>

- Install via the **[Kanboard](https://github.com/kanboard/kanboard "Kanboard - Kanban Project Management Software") Plugin Directory** or see [INSTALL.md](../master/INSTALL.md)
- Read the full [**Changelog**](../master/changelog.md "See changes") to see the latest updates

</details>
<details>
    <summary><strong>Compatibility</strong></summary>

- Requires [Kanboard](https://github.com/kanboard/kanboard "Kanboard - Kanban Project Management Software") ≥`1.2.20`
- **Other Plugins & Action Plugins**
  - _No known issues_
- **Core Files & Templates**
  - `01` Template override
  - _No database changes_

</details>
<details>
    <summary><strong>Translations</strong></summary>

- _Starter template available_

</details>

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#usage">&#8592; Previous</a>] [<a href="#license">&#8594; Next</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## Authors & Contributors

- [@Andrej Thomas Dobrev](https://github.com/andrej2431) - Author
- _Contributors welcome_

<p align="right">[<a href="#user-content-readme-bottom">&#8595; Bottom</a>] [<a href="#installation--compatibility">&#8592; Previous</a>] [<a href="#user-content-readme-top">&#8593; Top</a>]</p>

## License

- This project is distributed under the [MIT License](../master/LICENSE "Read The MIT license")

---

<p align="center">
    <a href="https://github.com/andrej2431/KanboardGit/stargazers" title="View Stargazers">
        <img src="https://img.shields.io/github/stars/andrej2431/KanboardGit?logo=github&style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/forks" title="See Forks">
        <img src="https://img.shields.io/github/forks/andrej2431/KanboardGit?logo=github&style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/blob/master/LICENSE" title="Read License">
        <img src="https://img.shields.io/github/license/andrej2431/KanboardGit?style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/issues" title="Open Issues">
        <img src="https://img.shields.io/github/issues-raw/andrej2431/KanboardGit?style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/issues?q=is%3Aissue+is%3Aclosed" title="Closed Issues">
        <img src="https://img.shields.io/github/issues-closed/andrej2431/KanboardGit?style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/discussions" title="Read Discussions">
        <img src="https://img.shields.io/github/discussions/andrej2431/KanboardGit?style=flat-square" alt="KanboardGit">
    </a>
    <a href="https://github.com/andrej2431/KanboardGit/compare/" title="Latest Commits">
        <img alt="GitHub commits since latest release (by date)" src="https://img.shields.io/github/commits-since/andrej2431/KanboardGit/latest?style=flat-square">
    </a>
</p>
<p align="right">[<a href="#user-content-readme-top">&#8593; Top</a>]</p>
<a name="user-content-readme-bottom"></a>
