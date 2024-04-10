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
    dealType: keyof FilterDealTypes
    defaultDealType: FilterDealType
    dealTypes: FilterDealTypes
    defaultRoominess: FilterRoom
    roominess: FilterRoominess
    defaultPrice: FilterPrice
    prices: FilterPrices
}

export type FilterInput = {
    name: string
    value: string
}

export type FilterDealType = FilterInput
export type FilterDealTypes = {
    sale: FilterDealType
    rent: FilterDealType
}

export type FilterRoom = FilterInput
export type FilterRoominess = FilterRoom[]

export type FilterPrice = FilterInput
export type FilterPrices = FilterPrice[]

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    lang: Lang
};
