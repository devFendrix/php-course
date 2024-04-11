const formCars = document.getElementById('form_cars')
const model = document.getElementById('model')
const brand = document.getElementById('brand')
const price = document.getElementById('price')
const nb_seat = document.getElementById('nb_seat')
const submitBtn = document.getElementById('submit-btn')

submitBtn.addEventListener('click', function() {
    if(model.value.length > 0 && brand.value.length > 0 && price.value.length > 0 && nb_seat.value.length > 0){
        formCars.submit()
    } else {
        console.log('Une ou plusieurs valeurs sont vides')
    }
})