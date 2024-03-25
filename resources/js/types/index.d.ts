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
    roominess: FilterRoom[]
    prices: FilterPrice[]
    areas: FilterArea[]
}

type FilterInput = {
    name: string
    value: string
    exists_in_query: boolean
}

export type FilterDealType = FilterInput
export type FilterRoom = FilterInput
export type FilterPrice = FilterInput
export type FilterArea = FilterInput

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    lang: Lang
};
