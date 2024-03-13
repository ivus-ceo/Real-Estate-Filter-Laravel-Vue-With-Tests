import { usePage } from "@inertiajs/vue3";

export default function useLang(path) {
    const parts = path.split('.');
    const page = usePage()
    let lang = page.props.lang;

    parts.map((part) => {
        lang = lang[part] ? lang[part] : part
    })

    return lang
}
