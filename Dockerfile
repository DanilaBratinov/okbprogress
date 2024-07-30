FROM nginx:latest
COPY ./code/* /usr/share/nginx/html
EXPOSE 80
