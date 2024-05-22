import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type AppEvents = FilterEvents

export type FilterEvents = {
    'filter:resetRange': void
}

export type FilterQueries = Record<string, FilterItem | string | number | boolean>

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    trans: Record<string, string | Object>;
};
