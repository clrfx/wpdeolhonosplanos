# Mapa dos Planos - Ação Educativa

# Temas utilizados

* [Twentytwelve](http://wordpress.org/extend/themes/twentytwelve/)
* [Ação Educativa (customizado)](https://github.com/pmarkun/mapadosplanos-theme)


Na pasta de temas:

    wget http://wordpress.org/extend/themes/download/twentytwelve.1.0.zip
    git clone git://github.com/pmarkun/mapadosplanos-theme.git
    
# Plugins utilizados

* [Email Alerts](http://wordpress.org/extend/plugins/email-alerts/)
* [mapbox](http://wordpress.org/extend/plugins/mapbox/)
* [Contact Form 7](http://wordpress.org/extend/plugins/contact-form-7/)
* [Attachments](http://wordpress.org/extend/plugins/attachments/)
* [WP CSV](http://wordpress.org/extend/plugins/wp-csv/)
* [WP-reCAPTCHA](http://wordpress.org/extend/plugins/wp-recaptcha/)
* [Content Slide](https://github.com/pmarkun/mapadosplanos-content-slide/)
* [Mapa dos Planos Plugin](https://github.com/pmarkun/mapadosplanos-plugin/)
* [Types](http://wordpress.org/extend/plugins/types/)
* [Google Analytics for Wordpress](http://wordpress.org/extend/plugins/google-analytics-for-wordpress/)

Apenas para desenvolvimento:
 
* [Import users from csv](http://wordpress.org/extend/plugins/import-users-from-csv/)

Apenas para o deploy:

* [WP-SuperCache](http://wordpress.org/extend/plugins/wp-super-cache/)

Na pasta de plugins:

    wget http://downloads.wordpress.org/plugin/wp-super-cache.1.2.zip
    wget http://downloads.wordpress.org/plugin/wp-recaptcha.3.1.6.zip
    wget http://downloads.wordpress.org/plugin/attachments.1.6.2.1.zip
    wget http://downloads.wordpress.org/plugin/mapbox.1.1.1.zip
    wget http://downloads.wordpress.org/plugin/contact-form-7.3.3.1.zip
    wget http://downloads.wordpress.org/plugin/import-users-from-csv.0.5.1.zip
    wget http://downloads.wordpress.org/plugin/wp-csv.1.3.6.zip
    wget http://downloads.wordpress.org/plugin/google-analytics-for-wordpress.4.2.8.zip
    wget http://downloads.wordpress.org/plugin/email-alerts.1.2.zip
    wget http://downloads.wordpress.org/plugin/types.1.2.2.zip
    wget http://downloads.wordpress.org/plugin/google-analytics-for-wordpress.4.3.3.zip
    git clone git://github.com/pmarkun/mapadosplanos-content-slide.git
    git clone git://github.com/pmarkun/mapadosplanos-plugin.git
       
# Como preparar os arquivos

1) Importar o conteúdo do arquivo `embedded-types/settings.xml` no plugin Types.

Opcionalmente você pode apenas descomentar a linha no `functions.php`.

2) Importar o `data/wp_munic2011_users.csv` usando o plugin Import users from csv. 

Isso vai importar todos os munícipios como nome de usuário atribuindo como senha o código do IBGE.

3) Importar o `data/wp_munic2011_posts.csv` usando o plugin WP CSV.

Isso vai importar todos os munícipios e suas respostas no IBGE Munic 2011 como posts do tipo `municipio`.

*Atenção* talvez seja necessário alterar o `memory_limit` e o `max_execution_time` nas configurações do Apache.

