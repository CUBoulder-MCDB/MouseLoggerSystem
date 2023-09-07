# Mouse Cage Logger System

## Background

Funded by the Leinwand lab, in 2015 Frank Hague developed this software that tracks the cycles of each cage's exercise wheel.

## Installation

### Requirements

Originally developed on the Raspberry Pi platform. This software will work in any Linux with PHP installed.

It is assumed that the system does not have a static IP address. The PHP script "bin/send_IP.php" will assemble and send an "index.html" file to any system via SSH. You can serve this file using any web server you want.

### Setup

Connect all Arduino's to the system and power everything on.

This software assumes the user's account is "pi" (hint). The user does not need admin privs.

Copy the "bin" directory into the user's home directory.

Create an SSH Key and setup keyed authentication on the web server.

Create a crontab using the "bin/crontab.txt" file as your guide.

Modify the "bin/send_IP.php" file as needed to work with your web server.

## Usage

All data is collected in a "~/data" directory.

View the "bin/README.txt" file for operation specifics.