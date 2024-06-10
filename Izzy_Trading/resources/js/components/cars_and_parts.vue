<template>

    <nav class="navbar navbar-light navbar-expand-sm bg-dark-subtle ">
        <h2 class="text-primary title"> Cars and parts </h2>
        <button class="border-0 nav-button" @click="selector=0"> cars</button>
        <button class="border-0 nav-button" @click="selector=1"> parts</button>

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
                            <input class="input-add" id="car_name" v-model="car_form.name" required>

                            Is the car registered?
                            <label for="is_registered"> yes </label>
                            <input class="input-add" id="is_registered" type="radio" :value=true
                                   v-model="car_form.is_registered"
                                   required>
                            <label for="is_registered"> no </label>
                            <input class="input-add" id="is_registered" type="radio" :value=false
                                   v-model="car_form.is_registered"
                                   required>

                            <label for="registration_number"
                                   :class="car_form.is_registered ? 'reg_number_visible' : 'reg_number_hidden'">
                                registration number </label>
                            <input class="input-add" id="registration_number"
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
                        <input class="filter-input" @input="xsearch(inputName, cars,'name')"
                               v-model="inputName">
                    </td>


                    <td class="border-2">
                        <input class="filter-input"
                               @input="xsearch(inputRegistrationNumber, cars,'registration_number')"
                               v-model="inputRegistrationNumber">
                    </td>

                    <td class="border-2">
                        <button class="filter-button" @click="xsearch(true,cars,'is_registered')"> registered</button>
                        <button class="filter-button" @click="xsearch(false,cars,'is_registered')"> unregistered
                        </button>
                        <button class="filter-button" @click="setActive(cars)"> all</button>
                    </td>

                    <td class="border-2 ">
                        <button class="just-taking-space"> edit</button>
                        <button class="just-taking-space"> delete</button>
                    </td>


                </tr>

                <tr v-if="cars.length == 0">
                    <td></td>
                    <td> no cars yet</td>
                    <td></td>
                </tr>


                <tr v-else v-show="car.active" v-for="car in this.cars">

                    <td class="border-2">
                        <input v-model="car.name" :disabled="car.disabled" class="edit-input text-center bg-dark ">

                    </td>
                    <td v-if="!car.is_registered" class="border-2">
                        <input v-model="nonumber" :disabled="car.disabled"
                               class="edit-input text-center bg-dark">
                    </td>
                    <td v-else>
                        <input v-model="car.registration_number" :disabled="car.disabled"
                               class="edit-input text-center bg-dark">
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

        <div>

            <div v-if="selector == 1" class=" text-center p-2 ">

                <table class="border  border-danger-subtle border-2 my_table">

                    <tr>
                        <td colspan="4">
                            <div><h2 class="text-info">Parts</h2></div>
                            <button @click="addPart=true" class="float-end add_car "> add a part</button>
                            <br>

                            <form v-if="addPart==true" @submit.prevent="savePart">

                                <label for="part_name"> name </label>
                                <input class="input-add" id="part_name" v-model="part_form.name" required>

                                <label for="car_name"> serial number </label>
                                <input class="input-add" id="car_name" v-model="part_form.serial_number" required>

                                <div class="xdropdownSearch mt-3">

                                    <label for="dmenu"> select a car </label>
                                    <input @input="xsearch(part_form.car,cars,'name')" id="dmenu"
                                           class="edit-input input-add" v-model="part_form.car" required>

                                    <div class="xdropdown-content">

                                        <div v-for="car in cars">

                                            <button v-if="car.active == true" @click="this.part_form.car = car.name"
                                                    type="button"> {{ car.name }}
                                            </button>

                                        </div>

                                    </div>
                                </div>


                                <button type="submit"> save</button>

                            </form>

                        </td>

                    </tr>

                    <tr class="border-2 ">

                        <th class="border-2"> name</th>
                        <th class="border-2"> serial number</th>
                        <th class="border-2"> car id</th>

                    </tr>

                    <tr>
                        <td class="border-2">
                            <input class="filter-input" @input="xsearch(inputName, parts,'name')"
                                   v-model="inputName">

                        </td>


                        <td class="border-2">
                            <input class="filter-input"
                                   @input="xsearch(inputSerialNumber, parts,'serialnumber')"
                                   v-model="inputSerialNumber">
                        </td>

                        <td class="border-2">

                            <input class="filter-input"
                                   @input="xsearch(inputCar, parts,'car_id')"
                                   v-model="inputCar">
                        </td>

                        <td class="border-2 ">
                            <button class="just-taking-space"> edit</button>
                            <button class="just-taking-space"> delete</button>
                        </td>


                    </tr>

                    <tr v-if="parts.length == 0">
                        <td></td>
                        <td> no parts yet</td>
                        <td></td>
                    </tr>


                    <tr v-else v-show="part.active" v-for="part in this.parts">


                        <td class="border-2">
                            <input v-model="part.name" :disabled="part.disabled"
                                   class="edit-input text-center bg-dark ">
                        </td>

                        <td class="border-2">
                            <input v-model="part.serialnumber" :disabled="part.disabled"
                                   class="edit-input text-center bg-dark ">
                        </td>


                        <td v-if="part.disabled" class="border-2">

                            <input v-model="part.car_id" :disabled="part.disabled"
                                   class="edit-input text-center bg-dark ">
                        </td>
                        <td v-else>

                            <div class="xdropdownSearch mt-3">

                                <input @input="xsearch(part.car_id,cars,'name')" id="dmenu1"
                                       class="edit-input text-center bg-dark " v-model="part.car_id" required>

                                <div class="xdropdown-content">

                                    <div v-for="car in cars">

                                        <button v-if="car.active == true" @click="part.car_id = car.name"
                                                type="button"> {{ car.name }}
                                        </button>

                                    </div>

                                </div>

                            </div>


                        </td>


                        <td class="border-2 ">
                            <button @click="editPart(part)" class="edit"> {{ part.disabled ? 'edit' : 'save' }}</button>
                            <button @click="deletePart(part.id)" class="delete"> delete</button>
                        </td>


                    </tr>

                </table>


            </div>


        </div>


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

            part_form: {
                name: '',
                serialnumber: '',
                car_id: ''
            },

            disabled: [],

            selector: '0',
            addCar: false,
            addPart: false,
            inputName: '',
            inputRegistrationNumber: '',
            inputSerialNumber: '',
            inputCar: '',

            nonumber: '-'
        }
    },
    mounted() {
        this.getCars();
        this.getParts();
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

        getParts() {
            axios.get('cars-and-parts/parts')
                .then(response => {
                    this.parts = response.data,
                        this.setActive(this.parts),
                        this.setDisabled(this.parts)
                    this.idToCarName()
                })
                .catch(error => console.log(error))


        },

        idToCarName() {

            for (let i = 0; i < this.parts.length; i++) {

                for (let j = 0; j < this.cars.length; j++) {
                    if (this.parts[i].car_id == this.cars[j].id) {
                        this.parts[i].car_id = this.cars[j].name
                    }
                }
            }

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

        editPart(part) {

            if (part.disabled) {
                for (let i = 0; i < this.parts.length; i++) {

                    if (this.parts[i].id == part.id) {

                        this.parts[i].disabled = false;
                    }

                }
            } else {

                axios.post('cars-and-parts/update-part', part)
                    .then()
                    .catch(error => console.log(error))

                part.disabled = !part.disabled

            }


        },

        deleteCar(id) {

            axios.delete(`cars-and-parts/delete/${id}`)
                .then(this.getCars)
                .catch(error => console.log(error))

        },

        deletePart(id) {

            axios.delete(`cars-and-parts/delete-part/${id}`)
                .then(this.getParts)
                .catch(error => console.log(error))
        },

        savePart() {
            axios.post('cars-and-parts/parts', this.part_form)
                .then(this.getParts)
                .catch(error => console.log(error))

            this.addPart = false
            Object.keys(this.part_form).forEach((i) => this.part_form[i] = null);

        },


        xsearch(key, object, column) {

            if (column == 'is_registered') {
                this.setActive(this.cars)
                for (let i = 0; i < object.length; i++) {
                    if ((!object[i][column]) == key) {
                        object[i].active = false

                    }
                }

            } else {

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

.input-add {
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

.edit-input {
    color: burlywood;
    width: 50%;
    padding: 1px;
    border: 2px;
    text-align: center;

}


.filter-input {
    font-size: 0.9em;
    width: 50%;
}

.filter-button {
    font-size: 0.7em;
}

.add_car {
    background-color: #146c43;
    font-size: 0.9em;
}

.nav-button {
    background-color: inherit;
    margin-left: 1em;

}

.nav-button:hover {
    background-color: #6c757d;
}

th {
    color: #ef4444;
}

td {
    color: burlywood;
}

.just-taking-space {
    visibility: hidden;
}

.title {
    margin-left: 10px;
}


.xdropdownSearch {

    display: inline-block;

}


.xdropdown-content {

    display: none;
    position: absolute;

    transform: translate(+150%);
    background-color: #f9f9f9;
    width: fit-content;
    z-index: 1;
}



.xdropdownSearch:hover .xdropdown-content {
    display: block;
}


</style>
