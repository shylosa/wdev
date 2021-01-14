
//For generate bundle.js need run:
//browserify wrapper.js -o bundle.js

let xhr = require("xmlhttprequest").XMLHttpRequest;

//Create new XMLHttpRequest (bypassing CORS restrictions)
let request = new xhr();
request.open('GET', 'http://wrapper.loc/loader.php', true);
request.responseType = 'document';

request.onload = function () {
    if (this.status >= 200 && this.status < 400) {
        console.log('OK request!');

        let data = this.responseText;
        //Parse string from XMLHttpRequest to new DOM
        let remoteHtml = new DOMParser().parseFromString(data, "text/html");

        //Your's tag
        let tag = 'script';
        let elements = remoteHtml.querySelectorAll(tag);

        //We wrap the selected tag in itself
        let wrap = function (toWrap, wrapper) {
            wrapper = remoteHtml.createElement(wrapper);
            toWrap.parentNode.appendChild(wrapper);

            return wrapper.appendChild(toWrap);
        };

        elements.forEach(element => wrap(element, tag));

        console.log(remoteHtml.documentElement.innerHTML);
    } else {
        console.log('Server return error!');
    }
};

request.onerror = function () {
    console.log('Error load url!');
};

request.send();



