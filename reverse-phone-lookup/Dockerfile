FROM node:latest

WORKDIR /home/node/app

COPY package.json /home/node/app
COPY package-lock.json /home/node/app

RUN rm -rf node_modules
RUN npm install gulp-cli --global
RUN npm install
RUN gulp --version