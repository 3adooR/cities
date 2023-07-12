import {createStore} from 'vuex';
import axios from 'axios';

const BACKEND_URL = `http://${self.location.hostname}`;
const API_URL = `${BACKEND_URL}/api/v1/`;

const errorAlert = (error) => {
    console.error(error);
    document.getElementById("message").innerHTML = `<span class="text-red-600">ERROR: ${error.message}</span>`;
}

const getUserId = () => {
    return parseInt(document.querySelector("meta[name='user_id']").getAttribute('content'));
}

export default createStore({
    state: {
        countries: [],
        message: '',
    },
    getters: {
        getCountries: state => {
            return state.countries;
        },
        getMessage: state => {
            return state.message;
        }
    },
    mutations: {
        FETCH_COUNTRIES(state, Countries) {
            state.countries = Countries;
            state.message = 'Countries list updated';
        },
        DELETE_COUNTRY(state, {id}) {
            let removeIndex = state.countries.map(country => country.id).indexOf(id);
            state.countries.splice(removeIndex, 1);
            state.message = `Country with id #${id} was successfully deleted.`;
        },
        SET_MESSAGE(state, {message}) {
            state.message = message;
        },
    },
    actions: {
        async fetchCountries({commit}) {
            await axios.get(`${API_URL}country/`).then(
                (response) => commit("FETCH_COUNTRIES", response.data.data),
                (error) => errorAlert(error)
            );
        },
        async deleteCountry({commit}, {id}) {
            await axios.delete(`${API_URL}country/${id}/del`).then(
                (response) => {
                    if (response.data.success) {
                        commit("DELETE_COUNTRY", {id});
                    } else {
                        errorAlert(response.data.data);
                    }
                },
                (error) => errorAlert(error)
            );
        },
        async updateCountry({commit}, country) {
            await axios.patch(
                `${API_URL}country/${country.id}/update`,
                country
            ).then(
                (response) => {
                    if (response.data.success) {
                        commit("SET_MESSAGE", {message: response.data.data});
                    } else {
                        errorAlert(response.data.data);
                    }
                },
                (error) => errorAlert(error)
            );
        },
        async addCountry({commit}, country) {
            await axios.put(
                `${API_URL}country/add`,
                {
                    user_id: getUserId(),
                    name: country.name,
                    iso: country.iso,
                }
            ).then(
                (response) => {
                    if (response.data.success) {
                        this.dispatch("fetchCountries");
                        commit("SET_MESSAGE", {message: response.data.data});
                    } else {
                        errorAlert(response.data.data);
                    }
                },
                (error) => errorAlert(error)
            );
        },
    },
    modules: {}
})
