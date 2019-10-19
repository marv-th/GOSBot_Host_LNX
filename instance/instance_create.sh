#/bin/bash

# $1 - PORT



cat > /opt/gosbot/instance/bot/ts3audiobot.toml << EOT
#GOSBot Setting
[bot]
bot_group_id = 0
generate_status_avatar = false
set_status_description = false
language = "en"
run = false

[bot.commands]
matcher = "ic3"
long_message = "Split"
long_message_split_limit = 1
color = true
command_complexity = 64

[bot.commands.alias]

[bot.connect]
server_password = { pw = "", hashed = false, autohash = false }
channel_password = { pw = "", hashed = false, autohash = false }
client_version = { build = "3.3.1 [Build: 1561236585]", platform = "Linux", sign = "2WaGpMt2Ky110SIh+byPcwkS+Dn9U2l7VffcJsoq2PNy0ZQ+o+N2i9wR4/7kEgtgB4SHIdoA7W8rQW2LLqUaAA==" }
address = ""
channel = ""
badges = ""
name = "GOSBot-Musikbot"

[bot.connect.identity]
key = ""
offset = 0
level = -1

[bot.reconnect]
ontimeout = ["1s", "2s", "5s", "10s", "30s", "1m"]
onkick = []
onban = []
onerror = ["30s"]
onshutdown = ["5m"]

[bot.audio]
volume = { default = 15.0, min = 0.0, max = 100.0 }
max_user_volume = 100.0
bitrate = 48
send_mode = "voice"

[bot.playlists]
path = "/opt/gosbot/playlists"
share = "Bot"

[bot.history]
enabled = false
fill_deleted_ids = false

[bot.events]
onconnect = ""
ondisconnect = ""
onidle = ""
idletime = "PT5M"

[configs]
bots_path = "/opt/gosbot/bots"

[db]
path = "ts3audiobot.db"

[factories]
media = { path = "/opt/gosbot/media" }

[tools]
youtube-dl = { path = "" }

[tools.ffmpeg]
path = "ffmpeg"

[rights]
path = "rights.toml"

[plugins]
path = "/opt/gosbot/plugins"
write_status_files = false

[plugins.load]

[web]
hosts = ["*"]
port = $1

[web.api]
enabled = true
command_complexity = 64
matcher = "exact"

[web.interface]
enabled = false
path = ""
EOT

cat > /opt/gosbot/instance/bot/rights.toml << EOT
"+" = [
    # Setup for usercmd
]

[[rule]]
ip = [ "51.89.27.57" ]
isapi=true
    "+" = "*"
EOT