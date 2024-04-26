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
    minValue: FilterInputDTO
    maxValue: FilterInputDTO
}

export interface FilterRangeGraphDTO {
    min: number
    max: number
    items: Record<string, number>
}

export interface FilterDropdownComponentDTO {
    queryName: string
    queryItem: FilterInputDTO
    defaultItem: FilterInputDTO
    items: FilterInputDTO[]
}

export interface FilterMultipleChoicesDropdownComponentDTO {
    queryName: string
    queryItems: FilterInputDTO[]
    defaultItems: FilterInputDTO[]
    items: FilterInputDTO[]
}

export interface FilterRangeComponentDTO {
    minQueryName: string
    maxQueryName: string
    queryNames: {
        min: string,
        max: string
    }
    minQueryItem: FilterInputDTO
    maxQueryItem: FilterInputDTO
    queryItems: {
        min: FilterInputDTO
        max: FilterInputDTO
    }
    minDefaultItem: FilterInputDTO;
    maxDefaultItem: FilterInputDTO;
    defaultItems: {
        min: FilterInputDTO
        max: FilterInputDTO
    };
    items: FilterRangeDTO[];
    // $graph;
}

export type DealType = 'sale' | 'rent'
export interface DealTypeDropdownComponentDTO extends FilterDropdownComponentDTO {
    dealType: DealType
    items: {
        sale: FilterInputDTO
        rent: FilterInputDTO
    }
}

export interface RoominessDropdownComponentDTO extends FilterMultipleChoicesDropdownComponentDTO {
    dealType: DealType
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
