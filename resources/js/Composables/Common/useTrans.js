import { usePage } from "@inertiajs/vue3";

export default function useTrans(path) {
    const objectKeys = [];

    const getObjectKeys = (obj, previousPath = '') => {
        // Step 1- Go through all the keys of the object
        Object.keys(obj).forEach((key) => {
            // Get the current path and concat the previous path if necessary
            const currentPath = previousPath ? `${previousPath}.${key}` : key;
            // Step 2- If the value is a string, then add it to the keys array
            if (typeof obj[key] !== 'object') {
                objectKeys.push(currentPath);
            } else {
                objectKeys.push(currentPath);
                // Step 3- If the value is an object, then recursively call the function
                getObjectKeys(obj[key], currentPath);
            }
        });
    }

    const page = usePage()
    const paths = path.split('.')
    let currentTranslation = page.props.trans

    paths.map((path) => {
        currentTranslation = currentTranslation[path] ? currentTranslation[path] : path
    })

    return (typeof currentTranslation === 'string') ? currentTranslation : path
}
