# hitch-teehee
simple chatting platform

## run it!
to run it first allow run.sh to execute using
```
chmod u+x run.sh
```

### to-deploy
to deploy the app at production ready state, call the run.sh script, and it by default the app will run in production mode
```
./run.sh
```

### to-develop
to develop the app run it with `DEV` as the argument
```
./run.sh DEV
```

#### ⚠️ NOTE ⚠️ 
any other value beside `DEV` or `PROD` in the argument would result in running the app on production mode

if you have an issue with running the command try running with highed privilege likeso:
```bash
sudo ./run.sh
# or
sudo ./run.sh DEV
```

and if you deploy this locally be sure to add
```
127.0.0.1  hitch.teehee
127.0.0.1  chat.hitch.teehee
127.0.0.1  api.hitch.teehee
```
to your `/etc/hosts` file, since our backend will check for the server name in your request

and if you want to use custom hostname, just add
```
127.0.0.1  <HOST_NAME>
127.0.0.1  chat.<HOST_NAME>
127.0.0.1  api.<HOST_NAME>
```
and change the `<HOST_NAME>` to your desired custom hostname, and change the HOSTNAME variable on `run.sh`


