<template>
    <div>
        <h2>Історія</h2>
        <ol>
            <li v-for="action in actions">
                {{ action }}
                (<a href="#" @click.prevent="undoAction(action)">Відмінити</a>)
            </li>
        </ol>
        <p v-if="!actions.length">
            Пусто
        </p>
    </div>
</template>

<script>
    import calls from "./calls";

    export default {
        data() {
            return {
                actions: []
            };
        },
        methods: {
            undoAction(action) {
                calls.undoAction(action.id)
                    .then(() => alert('Success!'))
                    .catch(() => alert('Error!'));
            }
        },
        created() {
            calls.getActions()
                .then(response => this.actions = response.data)
                .catch(() => alert('Error!'));
        }
    }
</script>
