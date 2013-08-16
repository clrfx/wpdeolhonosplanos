#!/bin/bash
cd plugins
wget https://github.com/pmarkun/mapadosplanos-plugin/archive/master.zip
unzip -o master.zip
rm master.zip
cd ../themes
wget https://github.com/pmarkun/mapadosplanos-theme/archive/master.zip
unzip -o master.zip
rm master.zip
cd ..
echo "Upgrade completo!"
cp -R themes/mapadosplanos-theme-master/data/languages/* languages/
echo "Tradução atualizada!"
