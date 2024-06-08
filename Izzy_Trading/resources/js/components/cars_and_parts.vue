<template>

    <div id="my-container" class="p-2 " >

        <div v-if="selector == 0" class=" text-center ">

            <table class="border  border-danger border-2 text-danger">


                <tr>
                    <td colspan="3">
                        <div> <h2>Cars</h2></div>
                         <button @click="addCar=true" class="float-end "> add a car</button>
                        <br>

                        <form v-if="addCar==true"  @submit.prevent=saveCar class="text">

                            <label for="car_name"> name </label>
                            <input id="car_name" v-model="car_form.name">

                            Is the car registered?
                            <label for="is_registered"> yes </label>
                            <input id="is_registered" type="radio" :value=true v-model="car_form.is_registered">
                            <label for="is_registered"> no </label>
                            <input id="is_registered" type="radio" :value=false v-model="car_form.is_registered">

                            <label :class="car_form.is_registered ? 'registration_number_visible' : 'registration_number_hidden'" for="registration_number" > registration number </label>
                            <input id="registration_number"  v-if="car_form.is_registered==true" v-model="car_form.registration_number">





                            <button type="button"> save </button>

                        </form>
                        <div v-if="car_form.is_registered==true">  je registrovane </div>

                    </td>

                </tr>

                <tr class="border-2 ">

                    <th class="border-2 "> name</th>
                    <th class="border-2"> registration number</th>
                    <th class="border-2"> registered</th>


                </tr>


                <tr v-for="car in this.cars">

                    <td class="border-2">{{ car.name }}</td>
                    <td v-if="car.registration_number == null" class="border-2"> -</td>
                    <td v-else class="border-2">{{ car.registration_number }}</td>
                    <td class="border-2">{{ car.is_registered }}</td>

                </tr>


            </table>


        </div>


    </div>

    <div>


    </div>


</template>

<script>
export default {
    data() {
        return {
            cars: [],

            car_form: {
                name: '',
                registration_number: '',
                is_registered: false
            },

            selector: '0',
            addCar: false
        }
    },
    mounted() {
        this.getCars();
    },
    methods: {

        getCars() {
            axios.get('cars-and-parts/cars')
                .then(response => this.cars = response.data)
                .catch(error => console.log(error))


        },

        saveCar(){

            axios.post('cars-and-parts/saveCar',this.car_form)
                .then()
                .catch(error => console.log(error))
        }


    },
}


</script>


<style>
table {
    border-spacing: 0;
    min-width: 700px;

}

input{
    margin-right: 15px;
    margin-left: 5px;
}


reg_number_visible{
    visibility: visible;
}

reg_number-hidden{
    visibility: hidden;
}

#car_name, #registration_number{
    width: 50px;

}

form {
    font-size: 0.7em;
}

#my-container{
    min-width: 100px;
}

</style>
