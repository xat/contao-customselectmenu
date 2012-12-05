.gitignore# notify-contao

what your looking at is a [notify-bridge](https://github.com/xat/notify-bridge) endpoint
for the PHP based Content Management System Contao3.

Basicly this extension provides an easy way to send push notifications out
of contao to the users in the frontend.

Code sample Serverside:

```php
// load the notify Class
$this->Import('Notify');

// Emit an event
$this->Notify->emit('awesome', array('Something awesome just happend in the backend!'));
```

And in Frontend you have some JS codesnippet like

```javascript
socket.on('awesome', function(data) {
  console.log(data.params); // will output: Something awesome just happend in the backend!
});
```

Yeah, that's cool. right? :-)

Be aware, to get this whole push notification thing running, you have to install
[notify-bridge](https://github.com/xat/notify-bridge) at first.
notify-bridge is a simple commandline tool based on node.js which is responsible
for bridging the notifications from the backend to the frontend.
notify-bridge must not be installed on the same server as the one your contao
installation is running on, but it's recommended so that latency is as
small as possible.

## License
Copyright (c) 2012 Simon Kusterer
Licensed under the MIT license.