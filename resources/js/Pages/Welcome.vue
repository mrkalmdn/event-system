<template>
    <Head title="Event" />

    <jet-banner />

    <div class="px-4 py-12">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-start-2 col-end-2">
                <form @submit.prevent="addEvent" class="space-y-4">
                    <div>
                        <jet-label for="name" value="Event" />

                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autocomplete="name"
                        />
                        <jet-input-error
                            :message="form.errors.name"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <jet-label for="from" value="From" />

                        <jet-input
                            id="from"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.from"
                            autocomplete="from"
                        />
                        <jet-input-error
                            :message="form.errors.from"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <jet-label for="to" value="To" />

                        <jet-input
                            id="to"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.to"
                            autocomplete="to"
                        />
                        <jet-input-error
                            :message="form.errors.to"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <label class="flex items-center">
                            <jet-checkbox
                                value="Mon"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Monday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Tue"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Tuesday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Wed"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Wednesday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Thu"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Thursday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Fri"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Friday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Sat"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Saturday
                            </span>
                        </label>

                        <label class="flex items-center">
                            <jet-checkbox
                                value="Sun"
                                v-model:checked="form.days"
                            />
                            <span class="ml-2 text-sm text-gray-600">
                                Sunday
                            </span>
                        </label>

                        <jet-input-error
                            :message="form.errors.days"
                            class="mt-2"
                        />
                    </div>

                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        type="submit"
                        >Add Event</jet-button
                    >
                </form>
            </div>
            <div class="col-start-3 col-end-6">
                <v-calendar is-expanded>
                    <template v-slot:day-content="{ day }">
                        <div
                            v-if="day.inMonth"
                            class="flex flex-col items-center h-24"
                        >
                            <label v-text="day.day" class="mb-2"></label>

                            <div v-if="props.event" v-show="hasEvent(day.id)">
                                <label
                                    v-text="props.event.name"
                                    class="
                                        block
                                        rounded-lg
                                        w-12
                                        lg:w-24
                                        mb-2
                                        p-0.5
                                        bg-gray-800
                                        text-sm text-center text-white
                                    "
                                ></label>
                            </div>
                        </div>
                    </template>
                </v-calendar>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import JetBanner from "@/Jetstream/Banner.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetButton from "@/Jetstream/Button.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import moment from "moment";

const props = defineProps({
    event: {
        type: Object,
    },
});

const form = useForm({
    name: null,
    from: moment().format("YYYY-MM-DD"),
    to: moment().format("YYYY-MM-DD"),
    days: [],
});

function addEvent() {
    form.post(route("events.store"), {
        onSuccess: () => form.reset(),
    });
}

function hasEvent(date) {
    return props.event.details.filter((a) => a.date === date).length > 0;
}
</script>
