
from AlibabaCrawler import AlibabaCrawler
from DataExtractor import DataExtractor
import json
import sys


def main(url):
    alibaba_crawler = AlibabaCrawler(url)
    page_source = alibaba_crawler.crawl()

    data_extractor = DataExtractor(page_source)
    data = data_extractor.extract()
    
    file_path = "data.json"

    with open(file_path, 'w', encoding='utf-8') as json_file:
        json.dump(data, json_file, ensure_ascii=False)

    print(json.dumps(data, ensure_ascii=False))


if __name__ == "__main__":
    if len(sys.argv) != 4:
        print("Usage: python main.py ARG1 ARG2 ARG3")
        sys.exit(1)
    src = sys.argv[1]
    dest = sys.argv[2]
    date = sys.argv[3]
    url = f"https://www.alibaba.ir/bus/{src}-{dest}?departing={date}"
    main(url)
