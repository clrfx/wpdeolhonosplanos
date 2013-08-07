## Importando os Dados do Munic

### Aplicativos necessários

* Wget
* Libreoffice
* Gnumeric
* Csvkit
* Tilemill

### Instruções para o Mapa

Baixe os dados do site do IBGE e o Mapa do Brasil:

    wget ftp://ftp.ibge.gov.br/Perfil_Municipios/2011/base_MUNIC_xls_2011.zip
    wget ftp://geoftp.ibge.gov.br/malhas_digitais/municipio_2007/escala_2500mil/proj_geografica_sirgas2000/brasil/55mu2500gsr.zip
    wget ftp://geoftp.ibge.gov.br/organizacao_territorial/localidades/Shapefile_SHP/BR_Localidades_2010_v1.dbf
    
Descompacte os arquivos:

    unzip base_MUNIC_xls_2011.zip
    unzip 55mu2500gsr.zip
    
Use o `gnumeric` para extrair apenas a tabela de Educação e Váriaves Externas:

    ssconvert -O "sheet=Educação" base_MUNIC_xls_2011.xls educ2011.txt
    ssconvert -O "sheet='Variáveis externas'" base_MUNIC_xls_2011.xls variaveis2011.txt
    ssconvert -O "sheet='Direitos humanos'" base_MUNIC_xls_2011.xls dh2011.txt
    
Lista de perguntas selecionadas (Munic2011):

* Código IBGE A1
* Tem plano? A172

* Níveis e modalidades abrangidas pelo plano:	
	* Ensino fundamental	A173
	* Educação infantil	A174
	* Educação de jovens e adultos A175
	* Educação especial	A176
	* Ensino médio	A177
	* Educação profissional	A178
	* Ensino superior	A179
	* Educação no campo	A180
	* Educação indígena	A181
	* Educação ambiental	A182
* Instâncias de Gestão Democrática	
	* Sistema Municipal de Ensino	A164
	* Fundo Municipal de Educação	A195
	* Conselho Municipal de Educação	A188
	* Conselho do FUNDEB A183
	* Conselhos Escolares	A184
	* Conselho de Alimentação Escolar	A185
	* Conselho do Transporte Escolar	A186
* Na rede municipal de ensino há programas e ações que visam:	
	* Combate à discriminação nas escolas 	A168
	* Combate à violência nas escolas 	A169
	* Formação na educação especial A167
* 
	* Na rede municipal de ensino existem escolas aptas a receber pessoas com deficiência?	A187
	* No município, há programa ou ações de educação em direitos humanos? 	A489


Use o `csvcut` para selecionar apenas as perguntas relevantes.

    csvcut -c "A1","A172","A173","A174","A175","A176","A177","A178","A179","A180","A181","A182","A164","A195","A188","A183","A184","A185","A186","A168","A169","A167","A187" educ2011.txt > educ2011.csv
    csvcut -c "A1","A569","A570","A572" variaveis2011.txt > variaveis2011.csv
    csvcut -c "A1","A489" dh2011.txt > dh2011.csv
    
Para preparar a tabela de coordenadas geograficas abra o `BR_Localidades_2010_v1.dbf` no LibreOffice e manda salvar como csv. Salve como `utf-8` e desmarque a opção 'Salvar campos como são exibidos'.

    csvgrep -c 17 -m "CIDADE" BR_Localidades_2010_v1.csv | csvcut -c 10,19,20 > coordenadas2011.csv
    sed -i 's/\([0-9][0-9][0-9][0-9][0-9][0-9]\)[0-9]/\1/' coordenadas2011.csv
    sed -i 's/"LONG,N,24,6"/lng/' coordenadas2011.csv
    sed -i 's/"LAT,N,24,6"/lat/' coordenadas2011.csv
    sed -i 's/"CD_GEOCODM,C,20"/A1/' coordenadas2011.csv

Use o `csvjoin` para juntar as duas tabelas.

    csvjoin -c "A1" educ2011.csv dh2011.csv variaveis2011.csv coordenadas2011.csv | csvcut -C 24,26,30 > munic2011.csv
    

Produzindo arquivo para importação no WP CSV:

		sed 's/A\([0-9][0-9][0-9]\)/wpcf-a\1/g' munic2011.csv > wp_munic2011.csv
		sed -i 's/A1/ibge/' wp_munic2011.csv
    python scripts/wp-csv.py

Infelizmente não encontramos uma forma de converter satisfatoriamente o arquivo `dbf` para `csv` via linha de comando. Para fazer isso abra o LibreOffice:
* Abra o arquivo `55mu2500gsr.dbf` no LibreOffice
* Clique em **Salvar Como** e clique em 'editar filtros' para escolher a codificação 'utf-8'
* Salve como `temporario.csv`

Agora utilize o `sed` e o `csvjoin` para conectar os arquivos do Munic2011 com as informações do Mapa e retornar as informações pro mapa.

    sed -i 's/\([0-9][0-9][0-9][0-9][0-9][0-9]\)[0-9]/\1/' temporario.csv
    csvjoin -c 1,1 temporario.csv munic2011.csv > 55mu2500gsr.csv
    
Infelizmente não encontramos uma forma de converter satisfatoriamente um arquivo `csv` para `dbf` via linha de comando. Para fazer isso abra o LibreOffice:
* Abra o arquivo `55mu2500gsr.csv` no LibreOffice
* Clique em **Salvar Como**.
* Salve como `55mu2500gsr.dbf` substituindo o arquivo anterior.

Agora você já pode importar o Shapefile `55mu2500gsr.shp` no TileMill e customizar o mapa.
    
### Arquivos relevantes

Lista de arquivos relevantes ao final do processo:

* educ2011.csv -> Csv contendo as respostas de educação.
* wp_munic2011_users.csv -> Lista de munícipios/usuários para importação.
* wp_munic2011_posts.csv -> Lista de munícipios/posts preparados para importação.
* 55mu2500gsr.* -> Shapefile contendo as respostas de educação, os limites dos munícipios brasileiros e dados censitários.