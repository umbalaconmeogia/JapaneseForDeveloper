# SearchLib - Search a text in list of string (an dictionary, for example).

The text will be split in atomic words and they are used for searching.

## Usage
<code>
  List<SearchDataRecord> searchData = YourDictionaryWordList;
  List<SearchDataRecord> searchResult = SearchLib.search(searchText, SearchLib.LANG_CODE_JAPANESE, searchData, 0);
  for (int i = 0; i < searchResult.size(); i++) {
      System.out.println(searchResult.get(i).getSearchData());
  }
</code>