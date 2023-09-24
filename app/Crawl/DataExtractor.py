from bs4 import BeautifulSoup


class DataExtractor:
    def __init__(self, page_source):
        self.soup = BeautifulSoup(page_source, 'html.parser')

    def extract(self):
        cards = self.soup.select('.available-card:not(.is-disabled)')
        data = []

        for card in cards:
            company = card.select_one(
                '.available-card__details strong.text-3.text-grays-600').text.strip()
            bus_type = card.select_one(
                '.available-card__details span.a-label.is-sm.ml-1.whitespace-nowrap span').text.strip()
            hour = card.select_one(
                '.available-card__details strong.text-5').text.strip()
            source_terminal = card.select_one(
                '.available-card__details .terminal.truncate').text.strip()
            destination_terminal = card.select_one(
                '.available-card__details  .destination-terminal-info div').text.strip()
            price = card.select_one(
                '.available-card__action > span > strong').text.strip()
            available_seats = card.select_one(
                '.available-card__action > div:last-child > span:first-child').text.strip()
            seat_tab_els = card.select(
                '.available-card__details [role="tabpanel"] .chairs > div > div')

            seat_rows = []
            for seat_tab_el in seat_tab_els:
                seat_row = []
                seat_row_els = seat_tab_el.select('.chair-cell-bus')
                for seat_row_el in seat_row_els:
                    seat_row.append(seat_row_el.text)
                seat_rows.append(seat_row)

            cards_data = {
                "company": company,
                "bus_type": bus_type,
                "hour": hour,
                "source_terminal": source_terminal,
                "destination_terminal": destination_terminal,
                "price": price,
                "available_seats": available_seats,
                "seat_rows": seat_rows
            }
            data.append(cards_data)

        self.data = data
        return data
