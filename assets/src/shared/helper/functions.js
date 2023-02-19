
const env = key => {
    return import.meta.env[key]
}

export { env }