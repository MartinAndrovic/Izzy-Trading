<template>

    <nav class="navbar navbar-light navbar-expand-sm bg-dark-subtle ">
        <h2 class="text-primary"> Cars and parts </h2>
        <button class="border-0 nav_button" @click="selector=0"> cars</button>
        <button class="border-0 nav_button" @click="selector=1"> parts</button>


    </nav>


    <div class="d-flex justify-content-center">

        <div v-if="selector == 0" class=" text-center p-2 ">

            <table class="border  border-danger-subtle border-2 my_table">


                <tr>
                    <td colspan="4">
                        <div><h2 class="text-info">Cars</h2></div>
                        <button @click="addCar=true" class="float-end add_car "> add a car</button>
                        <br>

                        <form v-if="addCar==true" @submit.prevent="saveCar">

                            <label for="car_name"> name </label>
                            <input id="car_name" v-model="car_form.name" required>

                            Is the car registered?
                            <label for="is_registered"> yes </label>
                            <input id="is_registered" type="radio" :value=true v-model="car_form.is_registered"
                                   required>
                            <label for="is_registered"> no </label>
                            <input id="is_registered" type="radio" :value=false v-model="car_form.is_registered"
                                   required>

                            <label for="registration_number"
                                   :class="car_form.is_registered ? 'reg_number_visible' : 'reg_number_hidden'">
                                registration number </label>
                            <input id="registration_number"
                                   :class="car_form.is_registered ? 'reg_number_visible' : 'reg_number_hidden'"
                                   v-model="car_form.registration_number" :required="car_form.is_registered">


                            <button type="submit"> save</button>

                        </form>

                    </td>

                </tr>

                <tr class="border-2 ">

                    <th class="border-2"> name</th>
                    <th class="border-2"> registration number</th>
                    <th class="border-2"> is registered</th>

                </tr>

                <tr>
                    <td class="border-2">
                        <input  class="edit_input" @input="xsearch(inputName, cars,'name')" id="dddmenu" v-model="inputName">

                    </td>


                    <td class="border-2">
                        <input class="edit_input" @input="xsearch(inputRegistrationNumber, cars,'registration_number')" id="dddmenu" v-model="inputRegistrationNumber">
                    </td>

                    <td class="border-2">
                        <input class="edit_input" @input="xsearch(inputValue, cars,'is_registered')" id="dddmenu" v-model="inputValue">
                    </td>


                </tr>

                <tr v-if="cars.length == 0">
                    <td></td>
                    <td> no cars yet</td>
                    <td></td>
                </tr>


                <tr v-else v-show="car.active"  v-for="car in this.cars">


                    <td class="border-2">
                        <input v-model="car.name" :disabled="car.disabled" class="edit_input text-center bg-dark ">

                    </td>
                    <td v-if="!car.is_registered" class="border-2">
                        -
                    </td>
                    <td v-else>
                        <input v-model="car.registration_number" :disabled="car.disabled" class="edit_input text-center bg-dark">
                    </td>

                    <td v-if="car.disabled" class="border-2"> {{ car.is_registered ? 'yes' : 'no' }}</td>

                    <td v-else>
                        <label for="is_registered"> yes </label>
                        <input id="is_registered" type="radio" :value="true" v-model="car.is_registered">
                        <label for="is_registered"> no </label>
                        <input id="is_registered" type="radio" :value=false v-model="car.is_registered">
                    </td>


                    <td class="border-2 ">
                        <button @click="editCar(car)" class="edit"> {{ car.disabled ? 'edit' : 'save' }}</button>
                        <button @click="deleteCar(car.id)" class="delete"> delete</button>
                    </td>


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
            parts: [],


            car_form: {
                name: '',
                registration_number: '',
                is_registered: false
            },

            disabled: [],

            selector: '0',
            addCar: false,
            inputName: '',
            inputRegistrationNumber: '',
            inputValue: ''
        }
    },
    mounted() {
        this.getCars();
    },
    methods: {

        getCars() {
            axios.get('cars-and-parts/cars')
                .then(response => {
                    this.cars = response.data,
                        this.setActive(this.cars),
                        this.setDisabled(this.cars)
                })
                .catch(error => console.log(error))


        },


        saveCar() {


            axios.post('cars-and-parts/cars', this.car_form)
                .then(this.getCars)
                .catch(error => console.log(error))

            this.addCar = false
            Object.keys(this.car_form).forEach((i) => this.car_form[i] = null);
        },

        setActive(object) {
            for (let i = 0; i < object.length; i++) {
                object[i].active = true;
            }
        },

        setDisabled(object) {
            for (let i = 0; i < object.length; i++) {
                object[i].disabled = true;
            }

        },


        editCar(car) {


            if (car.disabled) {
                for (let i = 0; i < this.cars.length; i++) {

                    if (this.cars[i].id == car.id) {

                        this.cars[i].disabled = false;

                    }

                }
            } else {


                axios.post('cars-and-parts/update', car)
                    .then()
                    .catch(error => console.log(error))


                car.disabled = !car.disabled


            }


        },

        deleteCar(id) {


            axios.delete(`cars-and-parts/delete/${id}`)
                .then(this.getCars)
                .catch(error => console.log(error))

        },


        xsearch(key,object,column) {



            if (key === "") {
                for (let i = 0; i < object.length; i++) {
                    object[i].active = true;
                }

            }

            let reg = new RegExp(key, "i")

            for (let i = 0; i < object.length; i++) {
                if (!reg.test(object[i][column])) {
                    object[i].active = false
                }
            }

        },


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

.td_buttons {
    min-width: 120px;
}

.edit, .delete {
    font-size: 0.6em;

}

.edit {
    margin-right: 1em;
    background-color: #0dcaf0;
}

.delete {
    background-color: #ef4444;


}

.edit_input{
    color: burlywood;
    width: 50%;
    padding: 1px;
    border: 2px;

}

.add_car{
    background-color: #146c43;
    font-size: 0.9em;
}
 .nav_button{
     background-color: inherit;
     margin-left: 1em;

 }

 .nav_button:hover{
     background-color: #6c757d;
 }

th{
     color: #ef4444;
 }

td{
    color: burlywood;
}
</style>
