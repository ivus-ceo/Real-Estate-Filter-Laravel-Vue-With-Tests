import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type AppEvents = FilterEvents

export type FilterEvents = {
    'filter:resetPrice': void
    'filter:updatePrice': [number, number]
}

export type FilterBody = Record<string, FilterInputDTO | FilterInputDTO[] | FilterRangeDTO | FilterRangeDTO[] | string | number | boolean | null | undefined>

export interface FilterComponentDTO {
    dealTypeDropdownComponent: DealTypeDropdownComponentDTO
    roominessDropdownComponent: RoominessDropdownComponentDTO
    priceRangeComponent: PriceRangeComponentDTO
}

export interface FilterInputDTO {
    name: string
    value: string
}

export interface FilterRangeDTO {
    name: string
    minValue: number
    maxValue: number
}

export interface FilterRangeGraphDTO {
    min: number
    max: number
    items: Record<string, number>
}

export interface FilterDropdownComponentDTO {
    query: string
    items: FilterInputDTO[]
    default: FilterInputDTO
}

export interface FilterRangeComponentDTO {
    query: string
    current: FilterRangeDTO
    default: FilterRangeDTO
    items: FilterRangeDTO[]
    graph: FilterRangeGraphDTO
}

export type DealType = 'sale' | 'rent'
export interface DealTypeDropdownComponentDTO extends FilterDropdownComponentDTO {
    dealType: DealType
    items: {
        sale: FilterInputDTO
        rent: FilterInputDTO
    }
}

export interface RoominessDropdownComponentDTO extends FilterDropdownComponentDTO {
    items: {
        any: FilterInputDTO
        0: FilterInputDTO
        1: FilterInputDTO
        2: FilterInputDTO
        3: FilterInputDTO
        4: FilterInputDTO
    }
}

export interface PriceRangeComponentDTO extends FilterRangeComponentDTO {
    dealType: DealType
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
