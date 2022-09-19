# JioTVServer

Grab streaming links of JioTV channels and play on mobile, PC etc..

NOTE: It only works in Indian VPS due to geoblocking

## Features
- Free of cost :)
- Easy to set-up and use
- High Quality Streaming
- Fast 🔥

## Installation

### Android/Termux
<details>
  <summary>Click to expand!</summary>

```bash
# Upgrade system packages
pkg update && pkg upgrade

# Get 'git' and 'PHP'
pkg install git php

# Download script
git clone https://github.com/Varun114-Techno/jiotv-server

# Run the script
php -S localhost:8585 -t "$HOME/jiotv-server"
```
</details>

## Usage

- [For first time users] Generate credentials using your Jio phone number and password.

  <details>
  Open your web browser and put the URL as follows
  
  ```
  Format: http://localhost:8585/login.php?user=<ph.no without +91>&pass=<password>
  Example: http://localhost:8585/login.php?user=6560263759&pass=JioTVRocks
  ```
  </details>

- For Web Play, the URL is: `http://localhost:8585`
- For IPTV Players (OTT Navigator or TiviMate), the playlist URL is: `http://localhost:8585/playlist.php`


## Credits

Huge thanks to the following people/projects that helped make this script what it is.

- techiesneh (base PHP script)
- avipatilpro (base PHP script)
- AvinashReddy3108 (base PHP script)
- botallen (for Kodi plugin)
- jeelpatel231 (helping with web play UI)
- elvistony (for Python version of JioTVServer)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[The Unlicense](https://choosealicense.com/licenses/unlicense/)
