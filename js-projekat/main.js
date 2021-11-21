'use strict';

const selectDestinacija = document.querySelector('#destinacija');
console.log(selectDestinacija);

let selected = selectDestinacija[selectDestinacija.selectedIndex].value;
console.log(selected);

const onChangeDestinacija = function () {
    selected = selectDestinacija[selectDestinacija.selectedIndex].value;
    console.log(selected);
    const avioKompanija = fetch('serverAvioKompanija.php').then(function (response) {
        console.log(response);
        return JSON.parse(response);
    }).then(r=>console.log(r));

    // fetch("server.php").then(async response => {
    //     try {
    //         const data = await response.json()
    //         console.log('response data?', data)
    //     } catch(error) {
    //         console.log('Error happened here!')
    //         console.error(error)
    //     }
    // })

    // const request = new XMLHttpRequest();
    // request.open('GET', "server.php");
    // request.send();
};


selectDestinacija.addEventListener('change',onChangeDestinacija);

