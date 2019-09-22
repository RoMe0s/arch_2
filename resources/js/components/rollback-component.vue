<template>
    <div>
        <h2>Rollback latest actions</h2>
        <div class="input-group">
            <input name="limit" type="number" min="0" v-model="limit" placeholder="К-сть дій" class="form-control">
            <div class="input-group-append">
                <button class="btn btn-info" @click="rollbackActions">
                    Rollback
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import calls from "./calls";

    export default {
        data() {
            return {
                limit: null
            }
        },
        methods: {
            rollbackActions() {
                calls.rollbackActionsCommand(this.limit)
                    .then(() => window.location.reload())
                    .catch(this.handleException);
            }
        }
    }
</script>
