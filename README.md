# AppPresser Custom Pushwoosh
Customizes the [AppPresser](https://apppresser.com/) push notifications from the AppPush plugin to customize the data sent to PushWoosh Remote API.

Takes advantage of the 'ap3_send_pushwoosh_data' filter in AppPush to customize the push data.  This example adds the featured image of a post to the data, but only for Android.

The data to be customized is the [payload](https://www.pushwoosh.com/v1.0/reference#createmessage) used by the [pushwoosh-phonegap-plugin](https://github.com/Pushwoosh/pushwoosh-phonegap-plugin).
