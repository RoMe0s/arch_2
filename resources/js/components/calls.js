export default {
    getShapes: () => axios.get('/api/shapes'),
    getActions: () => axios.get('/api/actions'),
    rollbackActionCommand: actionId => axios.post(`/api/command/${actionId}/rollback`),
    generateShapesCommand: () => axios.post('/api/command/generate-shapes'),
    changeColorCommand: () => axios.post('/api/command/change-color'),
    rollbackActionsCommand: limit => axios.post('/api/command/rollback', {limit})
};
