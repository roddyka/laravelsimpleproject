# Estágio 1: Construção da imagem
FROM php:8.0-apache as builder

# Instala as dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    curl

# Instala as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto para o contêiner
COPY . /var/www/html

# Define as permissões corretas para o diretório de armazenamento
RUN chown -R www-data:www-data /var/www/html/storage

# Copia o arquivo de configuração do Apache para o contêiner
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Estágio 2: Imagem final
FROM php:8.0-apache

# Copia os arquivos do estágio anterior para a imagem final
COPY --from=builder /var/www/html /var/www/html
COPY --from=builder /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

# Instala as dependências do MySQL
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libpq-dev

# Define as variáveis de ambiente para conexão com o banco de dados MySQL
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=my_database
ENV DB_USERNAME=root
ENV DB_PASSWORD=

# Define as permissões corretas para o diretório de armazenamento
RUN chown -R www-data:www-data /var/www/html/storage

# Define o diretório de trabalho
WORKDIR /var/www/html

# Inicia o servidor Apache
CMD ["apache2-foreground"]
