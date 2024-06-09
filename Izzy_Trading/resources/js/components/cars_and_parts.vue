<template>

    <nav class="navbar navbar-light navbar-expand-sm bg-dark-subtle ">
        <h2 class="text-primary"> Cars and parts </h2>
        <button @click="selector=0"> cars</button>
        <button @click="selector=1"> parts</button>


    </nav>




    <div class="d-flex justify-content-center">

        <div v-if="selector == 0" class=" text-center p-2 ">

            <table class="border  border-danger border-2 text-danger">


                <tr>
                    <td colspan="4">
                        <div><h2>Cars</h2></div>
                        <button @click="addCar=true" class="float-end "> add a car</button>
                        <br>

                        <form v-if="addCar==true" @submit.prevent="saveCar">

                            <label for="car_name"> name </label>
                            <input id="car_name" v-model="car_form.name">

                            Is the car registered?
                            <label for="is_registered"> yes </label>
                            <input id="is_registered" type="radio" :value=true v-model="car_form.is_registered">
                            <label for="is_registered"> no </label>
                            <input id="is_registered" type="radio" :value=false v-model="car_form.is_registered">

                            <label for="registration_number"
                                   :class="car_form.is_registered ? 'reg_number_visible' : 'reg_number_hidden'">
                                registration number </label>
                            <input id="registration_number"
                                   :class="car_form.is_registered ? 'reg_number_visible' : 'reg_number_hidden'"
                                   v-model="car_form.registration_number">


                            <button type="submit"> save</button>

                        </form>

                    </td>

                </tr>

                <tr class="border-2 ">

                    <th class="border-2"> name</th>
                    <th class="border-2"> registration number</th>
                    <th class="border-2"> is registered</th>

                </tr>


                <tr v-for="car in this.cars">


                    <td class="border-2">{{ car.name }}

                    </td>
                    <td v-if="car.registration_number == null" class="border-2"> </td>
                    <td v-else class="border-2">{{ car.registration_number }}</td>
                    <td v-if="car.is_registered" class="border-2"> yes</td>
                    <td v-else class="border-2"> no</td>
                    <td class="border-2">
                        <button> edit</button>
                        <button @click="coje(car.name)"> delete</button>
                    </td>


                </tr>

                <tr v-for="car in this.cars">



                        <td> co je</td>
                        <td> co je</td>
                        <td> co je</td>








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
            edit: false,

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
        coje(name){
          alert(name)
        },

        saveCar() {

            alert('uklada')

            axios.post('cars-and-parts/cars', this.car_form)
                .then(this.getCars, this.addCar = false)
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

input {
    margin-right: 15px;
    margin-left: 5px;
}


.reg_number_visible {
    visibility: visible;
}

.reg_number_hidden {
    visibility: hidden;
}

#car_name, #registration_number {
    width: 50px;

}

form {
    font-size: 0.7em;
}

#my-container {
    min-width: 100px;
}




</style>
