'use strict';

const selectDestinacija = document.querySelector('#destinacija');

const selectAvio = document.querySelector('#avio');

let selected = selectDestinacija[selectDestinacija.selectedIndex].value;

let selectedAvio = selectAvio[selectAvio.selectedIndex].value;

let avioKompanija={
    sifraAvioKompanija:0,
    naziv:""
};
const arrayAvio = [];

// let destinacijaAvio={
//     sifraDestinacija:0,
//     sifraAvioKompanija:0
// };
const arrayDestinacijaAvio = [];

const arrayDestinacija = [];

let destinacija={
    sifraDestinacija:0,
    naziv:""
};


const onChangeDestinacija = function(){
    // selected = selectDestinacija[selectDestinacija.selectedIndex].value;
    console.log(`Prvi poziv: ${selected}`);
    selectAvio.options.length = 0;


    fetch("serverAvioKompanija.php").then(function(response){
        return response.json();
    }).then(function (arr) {
        arrayAvio.length = 0;
        for (let i =0;i<arr.length;i++){
            arrayAvio.push(arr[i]);
        }
    });

    fetch("serverDestinacijaAvioKompanija.php").then(response =>{
        return response.json();
    }).then(function (arr) {
        arrayDestinacijaAvio.length = 0;
        for (let i =0;i<arr.length;i++){
            arrayDestinacijaAvio.push(arr[i]);
        }
    });

    fetch("serverDestinacija.php").then(function (response) {
        return response.json();
    }).then(function (arr) {
        selected = selectDestinacija[selectDestinacija.selectedIndex].value;
        console.log(selected);
        for (let i=0;i<arr.length;i++){
            const {sifraDestinacija,naziv} = arr[i];
            if(sifraDestinacija==selected){
                destinacija.sifraDestinacija = sifraDestinacija;
                destinacija.naziv = naziv;
                break;
            }
        }
    }).then(()=>{
        for (let i = 0; i < arrayDestinacijaAvio.length; i++) {
            if(destinacija.sifraDestinacija==arrayDestinacijaAvio[i].sifraDestinacija){
                for (let j = 0; j < arrayAvio.length; j++) {
                    if(arrayDestinacijaAvio[i].sifraAvioKompanija==arrayAvio[j].sifraAvioKompanija){
                        let option = document.createElement('option');
                        option.appendChild(document.createTextNode(arrayAvio[j].naziv));
                        option.value = arrayAvio[j].sifraAvioKompanija;
                        selectAvio.appendChild(option);
                    }
                }
            }
        }
    });
};

const onChangeAvio = function(){
    selectDestinacija.options.length = 0;


    fetch("serverDestinacija.php").then(function(response){
        return response.json();
    }).then(function (arr) {
        arrayDestinacija.length = 0;
        for (let i =0;i<arr.length;i++){
            arrayDestinacija.push(arr[i]);
        }
    });

    fetch("serverDestinacijaAvioKompanija.php").then(response =>{
        return response.json();
    }).then(function (arr) {
        arrayDestinacijaAvio.length = 0;
        for (let i =0;i<arr.length;i++){
            arrayDestinacijaAvio.push(arr[i]);
        }
    });

    fetch("serverAvioKompanija.php").then(function (response) {
        return response.json();
    }).then(function (arr) {
        selectedAvio = selectAvio[selectAvio.selectedIndex].value;
        console.log(selectedAvio);
        for (let i=0;i<arr.length;i++){
            const {sifraAvioKompanija,naziv} = arr[i];
            if(sifraAvioKompanija==selectedAvio){
                avioKompanija.sifraAvioKompanija = sifraAvioKompanija;
                avioKompanija.naziv = naziv;
                break;
            }
        }
    }).then(()=>{
        for (let i = 0; i < arrayDestinacijaAvio.length; i++) {
            if(avioKompanija.sifraAvioKompanija==arrayDestinacijaAvio[i].sifraAvioKompanija){
                for (let j = 0; j < arrayDestinacija.length; j++) {
                    if(arrayDestinacijaAvio[i].sifraDestinacija==arrayDestinacija[j].sifraDestinacija){
                        let option = document.createElement('option');
                        option.appendChild(document.createTextNode(arrayDestinacija[j].naziv));
                        option.value = arrayDestinacija[j].sifraDestinacija;
                        selectDestinacija.appendChild(option);
                    }
                }
            }
        }
    });
};

selectDestinacija.addEventListener('change',onChangeDestinacija);




selectAvio.addEventListener('change',onChangeAvio);