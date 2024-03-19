import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type Lang = {

}

export type FilterComponent = {
    deal_types: FilterDealType[]
    rooms: FilterRoom[]
    prices: FilterPrice[]
    areas: FilterArea[]
}

export type FilterDealType = {
    name: string
    value: string
}

export type FilterRoom = {
    name: string
    value: string
}

export type FilterPrice = {
    name: string
    value: string
}

export type FilterArea = {
    name: string
    value: string
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    lang: Lang
};
