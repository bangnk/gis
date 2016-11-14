cd ~/git
git init --bare gis.git
cd ~/
git clone bang@mac.local:/Users/bang/git/gis.git temp
mv temp/.git web
rm -rf temp

sudo /usr/local/mysql/support-files/mysql.server restart