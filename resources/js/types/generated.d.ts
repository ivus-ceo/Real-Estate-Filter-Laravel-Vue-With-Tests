declare namespace App.DTOs.Components.Filters {
export type FilterComponentDTO = {
dealTypeDropdownComponent: App.DTOs.Components.Filters.Dropdowns.DealTypes.FilterDealTypeDropdownComponentDTO;
roominessDropdownComponent: App.DTOs.Components.Filters.Dropdowns.Roominess.FilterRoominessDropdownComponentDTO;
priceRangeComponent: App.DTOs.Components.Filters.Ranges.Prices.FilterPriceRangeComponentDTO;
areaRangeComponent: App.DTOs.Components.Filters.Ranges.Areas.FilterAreaRangeComponentDTO;
dealType: App.Enums.Filters.DealTypes;
};
}
declare namespace App.DTOs.Components.Filters.Dropdowns.DealTypes {
export type FilterDealTypeDropdownComponentDTO = {
items: Record<App.Enums.Filters.DealTypes, App.DTOs.Filters.Items.FilterItem>;
dealType: App.Enums.Filters.DealTypes;
queryItem: App.DTOs.Filters.Items.FilterItem | null;
query: App.Enums.Filters.Queries;
defaultItem: App.DTOs.Filters.Items.FilterItem;
};
}
declare namespace App.DTOs.Components.Filters.Dropdowns.Roominess {
export type FilterRoominessDropdownComponentDTO = {
items: Record<App.Enums.Filters.Roominess, App.DTOs.Filters.Items.FilterItem>;
dealType: App.Enums.Filters.DealTypes;
queryItems: App.DTOs.Filters.Items.FilterItem[] | null;
query: App.Enums.Filters.Queries;
defaultItems: App.DTOs.Filters.Items.FilterItem[];
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Areas {
export type FilterAreaRangeComponentDTO = {
dealType: App.Enums.Filters.DealTypes;
minQueryItem: App.DTOs.Filters.Items.FilterItem | null;
maxQueryItem: App.DTOs.Filters.Items.FilterItem | null;
queries: {min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries};
defaultItems: {min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem};
queryItems: {min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem} | null;
minQuery: App.Enums.Filters.Queries;
maxQuery: App.Enums.Filters.Queries;
minDefaultItem: App.DTOs.Filters.Items.FilterItem;
maxDefaultItem: App.DTOs.Filters.Items.FilterItem;
graph: App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponent;
items: App.DTOs.Filters.Items.FilterRange[];
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Graphs {
export type BaseRangeGraphComponent = {
ranges: Record<string, number>;
minNumber: number;
maxNumber: number;
numberOfColumns: number;
};
}
declare namespace App.DTOs.Components.Filters.Ranges.Graphs.Areas {
export type AreaRangeGraphComponent = {
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
minQueryItem: App.DTOs.Filters.Items.FilterItem | null;
maxQueryItem: App.DTOs.Filters.Items.FilterItem | null;
queries: {min: App.Enums.Filters.Queries, max: App.Enums.Filters.Queries};
defaultItems: {min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem};
queryItems: {min: App.DTOs.Filters.Items.FilterItem, max: App.DTOs.Filters.Items.FilterItem} | null;
minQuery: App.Enums.Filters.Queries;
maxQuery: App.Enums.Filters.Queries;
minDefaultItem: App.DTOs.Filters.Items.FilterItem;
maxDefaultItem: App.DTOs.Filters.Items.FilterItem;
graph: App.DTOs.Components.Filters.Ranges.Graphs.BaseRangeGraphComponent;
items: App.DTOs.Filters.Items.FilterRange[];
};
}
declare namespace App.DTOs.Filters.Items {
export type BaseFilterItem = {
name: string;
};
export type FilterItem = {
value: string;
name: string;
};
export type FilterRange = {
minItem: App.DTOs.Filters.Items.FilterItem;
maxItem: App.DTOs.Filters.Items.FilterItem;
name: string;
};
}
declare namespace App.Enums.Filters {
export type Areas = ':10' | '10:20' | '20:40' | '40:60' | '60:80' | '80:120' | '120:200' | '200:500' | '500:';
export type DealTypes = 'sale' | 'rent';
export type Queries = 'dealType' | 'roominess' | 'minPrice' | 'maxPrice' | 'minArea' | 'maxArea' | 'search';
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
