<template>
    <div class="flex flex-col sm:flex-row">
        <div class="sm:w-1/4 sm:px-8 sm:py-8">
            <div class="relative mb-4">
                <label for="country_name" class="leading-7 text-sm text-gray-600">Country</label>
                <input type="text" id="country_name" v-model="newCountry.name" minlength="3" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
                <label for="country_iso" class="leading-7 text-sm text-gray-600">ISO</label>
                <input type="text" id="country_iso" v-model="newCountry.iso" minlength="2" maxlength="3" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <button v-on:click="addCountry()" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                Add country
            </button>
        </div>

        <div v-if="!countries.length" class="p-8">
            Please, add some countries..
        </div>
        <div v-else class="sm:w-3/4 sm:p-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 sm:text-left">
            <table class="table w-full border-gray-200 border-l border-r">
                <thead>
                <tr class="border-b border-t border-gray-200 bg-gray-100">
                    <th class="p-2">
                        ID
                    </th>
                    <th class="p-2">
                        Country name
                    </th>
                    <th class="p-2">
                        Country ISO
                    </th>
                    <th class="p-2">
                        Edit
                    </th>
                    <th class="p-2">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="country in countries" v-bind:key="country.id" class="border-b border-gray-200">
                    <td class="p-2">
                        {{ country.id }}
                    </td>
                    <td class="p-2">
                        <input type="text" v-model="country.name" placeholder="Country name" class="border-gray-100" minlength="3">
                    </td>
                    <td class="p-2">
                        <input type="text" v-model="country.iso" placeholder="Country ISO" class="border-gray-100" minlength="2" maxlength="3">
                    </td>
                    <td class="p-2">
                        <button v-on:click="updateCountry(country.id)" class="text-white bg-indigo-500 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-md">
                            Save
                        </button>
                    </td>
                    <td class="p-2">
                        <button v-on:click="deleteCountry(country.id)" class="px-4 py-2 font-medium text-gray-600 transition-colors duration-200 sm:px-6 hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="message" v-if="message.length" class="bg-gray-100 text-center text-md p-4">
        {{ message }}
    </div>
</template>

<script>
import {useStore} from 'vuex';
import {computed, ref, watch} from 'vue';

export default {
    name: "Country",
    created() {
        this.$store.dispatch("fetchCountries", {self: this});
    },
    setup() {
        const store = useStore();
        const countries = computed(() => store.getters.getCountries);
        const message = computed(() => store.getters.getMessage);
        const newCountry = ref({
            name: '',
            iso: ''
        });

        const getCountry = (id) => {
            return countries.value.find(country => country.id === id);
        }

        const validateIsoAndName = (newCountryData) => {
            let valid = false;
            let isoLength = newCountryData.iso.length;
            let nameLength = newCountryData.name.length;

            if (isoLength >= 2 && isoLength <= 3 && nameLength > 2) {
                valid = true;
            } else {
                store.commit('SET_MESSAGE', {
                    message: `Length of ISO should be 2 or 3 symbols, length of country name should be more than 2 symbols`
                });
            }

            return valid;
        }

        const addCountry = () => {
            let newCountryData = newCountry.value;
            if (validateIsoAndName(newCountryData)) {
                store.dispatch('addCountry', newCountryData);
            }
        }

        const updateCountry = (id) => {
            let newCountryData = getCountry(id);
            if (validateIsoAndName(newCountryData)) {
                store.dispatch('updateCountry', newCountryData);
            }
        }

        const deleteCountry = (id) => {
            store.dispatch('deleteCountry', {id});
        }

        watch(newCountry.value, async (val) => {
            let iso = val.iso;
            if (iso.length) {
                newCountry.value.iso = iso.toUpperCase();
            }
        });

        return {
            countries,
            message,
            newCountry,
            addCountry,
            updateCountry,
            deleteCountry,
        }
    }
}
</script>
