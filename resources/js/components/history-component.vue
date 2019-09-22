<template>
    <div>
        <h2>Actions history</h2>
        <ol>
            <li v-for="action in actions">
                {{ action.type }}
                (<a href="#" @click.prevent="rollbackAction(action)">Відмінити</a>)
            </li>
        </ol>
        <p v-if="!actions.length">
            Empty
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
            rollbackAction(action) {
                calls.rollbackActionCommand(action.id)
                    .then(() => window.location.reload())
                    .catch(this.handleException);
            }
        },
        created() {
            calls.getActions()
                .then(response => this.actions = response.data)
                .catch(this.handleException);
        }
    }
</script>
