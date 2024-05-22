declare namespace App.DTOs.Components.Filters {
export type FilterComponentDTO = {
filterDealTypeDropdownComponentDTO: App.DTOs.Components.Filters.Dropdowns.DealTypes.FilterDealTypeDropdownComponentDTO;
filterRoominessDropdownComponentDTO: App.DTOs.Components.Filters.Dropdowns.Roominess.FilterRoominessDropdownComponentDTO;
filterPriceRangeComponentDTO: App.DTOs.Components.Filters.Ranges.Prices.FilterPriceRangeComponentDTO;
filterAreaRangeComponentDTO: App.DTOs.Components.Filters.Ranges.Areas.FilterAreaRangeComponentDTO;
filterSearchComponentDTO: App.DTOs.Components.Filters.Searches.Search.FilterSearchComponentDTO;
dealType: App.Enums.Filters.DealTypes;
};
}
declare namespace App.DTOs.Components.Filters.Dropdowns.DealTypes {
export type FilterDealTypeDropdownComponentDTO = {
items: Record<App.Enums.Filters.DealTypes, App.DTOs.Filters.Items.FilterItemDTO>;
dealType: App.Enums.Filters.DealTypes;
queryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
query: App.Enums.Filters.Queries;
defaultItem: App.DTOs.Filters.Items.FilterItemDTO;
};
}
declare namespace App.DTOs.Components.Filters.Dropdowns.Roominess {
export type FilterRoominessDropdownComponentDTO = {
items: Record<App.Enums.Filters.Roominess, App.DTOs.Filters.Items.FilterItemDTO>;
dealType: App.Enums.Filters.DealTypes;
queryItems: App.DTOs.Filters.Items.FilterItemDTO[] | null;
query: App.Enums.Filters.Queries;
defaultItems: App.DTOs.Filters.Items.FilterItemDTO[];
};
}
declare namespace App.DTOs.Components.Filters.Ranges {
export type BaseFilterRangeComponentDTO = {
minQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
maxQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
queries: {min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries};
defaultItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO};
queryItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO} | null;
minQuery: App.Enums.Filters.Queries;
maxQuery: App.Enums.Filters.Queries;
minDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
maxDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
graph: App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponentDTO;
items: App.DTOs.Filters.Items.FilterRangeDTO[];
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Areas {
export type FilterAreaRangeComponentDTO = {
dealType: App.Enums.Filters.DealTypes;
minQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
maxQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
queries: {min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries};
defaultItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO};
queryItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO} | null;
minQuery: App.Enums.Filters.Queries;
maxQuery: App.Enums.Filters.Queries;
minDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
maxDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
graph: App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponentDTO;
items: App.DTOs.Filters.Items.FilterRangeDTO[];
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Graphs {
export type BaseRangeGraphComponentDTO = {
ranges: Record<string, number>;
minNumber: number;
maxNumber: number;
numberOfColumns: number;
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Graphs.Areas {
export type AreaRangeGraphComponentDTO = {
dealType: App.Enums.Filters.DealTypes;
ranges: Record<string, number>;
minNumber: number;
maxNumber: number;
numberOfColumns: number;
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Prices {
export type FilterPriceRangeComponentDTO = {
dealType: App.Enums.Filters.DealTypes;
minQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
maxQueryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
queries: {min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries};
defaultItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO};
queryItems: {min: App.DTOs.Filters.Items.FilterItemDTO, max: App.DTOs.Filters.Items.FilterItemDTO} | null;
minQuery: App.Enums.Filters.Queries;
maxQuery: App.Enums.Filters.Queries;
minDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
maxDefaultItem: App.DTOs.Filters.Items.FilterItemDTO;
graph: App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponentDTO;
items: App.DTOs.Filters.Items.FilterRangeDTO[];
};
}
declare namespace App.DTOs.Components.Filters.Searches {
export type BaseFilterSearchComponentDTO = {
queryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
query: App.Enums.Filters.Queries;
defaultItem: App.DTOs.Filters.Items.FilterItemDTO;
items: App.DTOs.Filters.Items.FilterList[];
};
}
declare namespace App.DTOs.Components.Filters.Searches.Search {
export type FilterSearchComponentDTO = {
queryItem: App.DTOs.Filters.Items.FilterItemDTO | null;
query: App.Enums.Filters.Queries;
defaultItem: App.DTOs.Filters.Items.FilterItemDTO;
items: App.DTOs.Filters.Items.FilterList[];
};
}
declare namespace App.DTOs.Filters.Items {
export type BaseFilterItemDTO = {
name: string;
};
export type FilterItemDTO = {
value: string;
name: string;
};
export type FilterListDTO = {
list: App.DTOs.Filters.Items.FilterItemDTO[];
name: string;
};
export type FilterRangeDTO = {
minItem: App.DTOs.Filters.Items.FilterItemDTO;
maxItem: App.DTOs.Filters.Items.FilterItemDTO;
name: string;
};
}
declare namespace App.Enums.Filters {
export type Areas = ':10' | '10:20' | '20:40' | '40:60' | '60:80' | '80:120' | '120:200' | '200:500' | '500:';
export type DealTypes = 'sale' | 'rent';
export type Queries = 'dealType' | 'roominess' | 'minPrice' | 'maxPrice' | 'minArea' | 'maxArea' | 'search' | 'building';
export type RentPrices = ':1000' | '1000:5000' | '5000:10000' | '10000:50000' | '50000:';
export type Roominess = 0 | 1 | 2 | 3 | 4;
export type SalePrices = ':100000' | '100000:500000' | '500000:1000000' | '1000000:5000000' | '5000000:';
}
declare namespace App.Enums.Langs {
export type AreaRanges = 'up_to' | 'over' | 'between';
export type PriceRanges = 'up_to' | 'over' | 'between';
}
declare namespace App.Enums.Money {
export type Currencies = '$' | '€' | '₽';
}
