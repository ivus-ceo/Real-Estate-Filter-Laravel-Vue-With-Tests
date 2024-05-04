declare namespace App.Enums.Filters {
export type AreaRanges = 'up_to' | 'over' | 'between';
export type Areas = ':10' | '10:20' | '20:40' | '40:60' | '60:80' | '80:120' | '120:200' | '200:500' | '500:';
export type DealTypes = 'sale' | 'rent';
export type PriceRanges = 'up_to' | 'over' | 'between';
export type Queries = 'dealType' | 'roominess' | 'minPrice' | 'maxPrice' | 'minArea' | 'maxArea' | 'search';
export type RentPrices = ':1000' | '1000:5000' | '5000:10000' | '10000:50000' | '50000:';
export type Roominess = 0 | 1 | 2 | 3 | 4;
export type SalePrices = ':100000' | '100000:500000' | '500000:1000000' | '1000000:5000000' | '5000000:';
}
declare namespace App.Enums.Money {
export type Currencies = '$' | '€' | '₽';
}
