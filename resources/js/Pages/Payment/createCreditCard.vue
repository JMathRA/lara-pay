<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { mask } from 'vue-the-mask';
</script>

<template>
    <Head title="Pagar com Cartão de credito" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Pagar com Cartão de credito
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <form @submit.prevent="validadePayment"
                        class="max-w-md mx-auto m-20">
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="value" value="Valor em reais R$" />

                            <TextInput
                                id="value"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.value"
                                autofocus
                                autocomplete="value"
                                v-mask="['#.##', '##.##' , '###.##' , '####.##' , '#####.##' , '######.##']"
                            />

                            <InputError class="mt-2" :message="form.errors.value" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="name" value="Nome" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="cpfCnpj" value="Digite o CPF ou CNPJ" />

                            <TextInput
                                id="cpfCnpj"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.cpfCnpj"
                                required
                                autofocus
                                autocomplete="cpfCnpj"
                                v-mask="['###.###.###-##' , '##.###.###/####-##' ]"
                            />

                            <InputError class="mt-2" :message="form.errors.cpfCnpj" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="holderName" value="Digite o nome como no cartão" />

                            <TextInput
                                id="holderName"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCard.holderName"
                                required
                                autofocus
                                autocomplete="holderName"
                            />

                            <InputError class="mt-2" :message="form.errors.holderName" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="number" value="Digite o numero do cartão" />

                            <TextInput
                                id="number"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.creditCard.number"
                                required
                                autofocus
                                autocomplete="number"
                                v-mask="'#### #### #### ####'"
                            />

                            <InputError class="mt-2" :message="form.errors.number" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="expiryMonth" value="Mês de expiração" />

                            <TextInput
                                id="expiryMonth"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.creditCard.expiryMonth"
                                required
                                autofocus
                                autocomplete="expiryMonth"
                                v-mask="'##'"
                            />

                            <InputError class="mt-2" :message="form.errors.expiryMonth" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="expiryYear" value="Ano de expiração" />

                            <TextInput
                                id="expiryYear"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.creditCard.expiryYear"
                                required
                                autofocus
                                autocomplete="expiryYear"
                                v-mask="'####'"
                            />

                            <InputError class="mt-2" :message="form.errors.expiryYear" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="ccv" value="CCV" />

                            <TextInput
                                id="ccv"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.creditCard.ccv"
                                required
                                autofocus
                                autocomplete="ccv"
                                v-mask="'###'"
                            />

                            <InputError class="mt-2" :message="form.errors.ccv" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCardHolderInfo.email"
                                required
                                autofocus
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="postalCode" value="CEP" />

                            <TextInput
                                id="postalCode"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCardHolderInfo.postalCode"
                                required
                                autofocus
                                autocomplete="postalCode"
                                v-mask="'#####-###'"
                            />

                            <InputError class="mt-2" :message="form.errors.postalCode" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="addressComplement" value="Endereço" />

                            <TextInput
                                id="addressComplement"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCardHolderInfo.addressComplement"
                                required
                                autofocus
                                autocomplete="addressComplement"
                            />

                            <InputError class="mt-2" :message="form.errors.addressComplement" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="addressNumber" value="Número" />

                            <TextInput
                                id="addressNumber"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCardHolderInfo.addressNumber"
                                required
                                autofocus
                                autocomplete="addressNumber"
                            />

                            <InputError class="mt-2" :message="form.errors.addressNumber" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <InputLabel for="phone" value="Telefone" />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.creditCardHolderInfo.phone"
                                required
                                autofocus
                                autocomplete="phone"
                                v-mask="'##-#####-####'"
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Gerar Boleto
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    directives: { mask },
    components: {
        Head,
        Link,
        TextInput,
        InputError,
        InputLabel,
        PrimaryButton,
    },
    props: {

    },
    data() {
        return {
            form:useForm({
                value: '',
                name: '',
                cpfCnpj: '',
                creditCard: {
                    holderName: '',
                    number: '',
                    expiryMonth: '',
                    expiryYear: '',
                    ccv: '',
                },
                creditCardHolderInfo: {
                    name: '',
                    email: '',
                    cpfCnpj: '',
                    postalCode: '',
                    addressNumber: '',
                    addressComplement: '',
                    phone: ''
                }
            })
        }
    },
    methods: {
        async validadePayment() {
            try {
               const validate = await axios.post(route('payment.validate'), this.form); 
            } catch (error) {
                this.showErrorsValidated(error.response.data.errors);
                console.log('validate',error);
            }
        },
        async createPayment() {
            
        },
        async finallyPayment() {
            
        },
        async savePayment() {
            
        },

        showErrorsValidated(data) {
            this.form.errors.value = data.value != undefined ? data.value[0] : '';
            this.form.errors.name = data.name != undefined ? data.name[0] : '';
            this.form.errors.cpfCnpj = data.cpfCnpj != undefined ? data.cpfCnpj[0] : '';
        }

    }
}
</script>
