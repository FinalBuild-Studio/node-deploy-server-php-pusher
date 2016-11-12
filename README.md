# node-deploy-server-php-pusher

### Installation
```sh
composer require capslock-studio/node-deploy-server-php-pusher dev-master
```

### How to use
```sh
DEPLOY_HOST={DEFINE_YOUR_NODE_DEPLOY_SERVER} SECRET={DEFINE_YOUR_SECRET} DIST={REMOTE_SERVER_DEPLOY_PATH} ./vendor/capslock-studio/node-deploy-server-php-pusher/bin/pusher [PARAMETER_WITH_DOUBLE_DASH]
```

### Other
It's compatible with travis, you have to assign `REPO` and `OWNER` in other CI tool.
