'use strict';

const selectDestinacija = document.querySelector('#destinacija');

const selectAvio = document.querySelector('#avio');

let selected = selectDestinacija[selectDestinacija.selectedIndex].value;

// let avioKompanija={
//     sifraAvioKompanija:0,
//     naziv:""
// };
const arrayAvio = [];

// let destinacijaAvio={
//     sifraDestinacija:0,
//     sifraAvioKompanija:0
// };
const arrayDestinacijaAvio = [];

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

selectDestinacija.addEventListener('change',onChangeDestinacija);

