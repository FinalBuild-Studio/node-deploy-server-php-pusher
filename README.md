# node-deploy-server-php-pusher

### Installation
```sh
composer global require capslock-studio/node-deploy-server-php-pusher dev-master
```

### How to use
```sh
DEPLOY_HOST={DEFINE_YOUR_NODE_DEPLOY_SERVER} SECRET={DEFINE_YOUR_SECRET} DIST={REMOTE_SERVER_DEPLOY_PATH} deploy-pusher [PARAMETER_WITH_DOUBLE_DASH]
```

### Support CI platform
* TravisCI
* Jenkins
* CircleCI

### Other CI platform
You have to assign `REPO` and `OWNER` to your environment variable in other CI tool.
