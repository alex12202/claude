#!/usr/bin/env bash
# Nahrá tému na server cez SSH (rsync) a aktivuje ju.
#
# Použitie:
#   SSH_TARGET="login@server" WP_PATH="/cesta/k/webu" ./wordpress/deploy.sh
#
#   SSH_TARGET  používateľ a server zo SSH prístupu (Websupport → WebAdmin → hosting → SSH)
#   WP_PATH     priečinok s WordPressom na serveri (tam, kde je wp-config.php)
#   SSH_PORT    port SSH (predvolený 22)
#
# Heslo sa pýta SSH. Lepšie je nahrať si SSH kľúč (ssh-copy-id), potom sa nepýta.
set -euo pipefail

: "${SSH_TARGET:?Nastav SSH_TARGET, napr. SSH_TARGET=login@server}"
: "${WP_PATH:?Nastav WP_PATH – priečinok s WordPressom na serveri}"
SSH_PORT="${SSH_PORT:-22}"
HERE="$(cd "$(dirname "$0")" && pwd)"

echo "→ Zostavujem tému"
python3 "$HERE/build_theme.py"

echo "→ Nahrávam do $SSH_TARGET:$WP_PATH/wp-content/themes/cistimeklimy/"
rsync -az --delete -e "ssh -p $SSH_PORT" \
  "$HERE/dist/cistimeklimy/" "$SSH_TARGET:$WP_PATH/wp-content/themes/cistimeklimy/"

echo "→ Aktivujem tému (ak je na serveri WP-CLI)"
ssh -p "$SSH_PORT" "$SSH_TARGET" "cd '$WP_PATH' && if command -v wp >/dev/null; then wp theme activate cistimeklimy; else echo 'WP-CLI nie je – aktivuj tému v administrácii: Vzhľad → Témy.'; fi"

echo "✓ Hotovo"
