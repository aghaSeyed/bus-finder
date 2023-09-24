import chromedriver_autoinstaller
from selenium import webdriver
from selenium.webdriver.common.by import By
import time


class AlibabaCrawler:
    def __init__(self, url):
        self.url = url
        chromedriver_autoinstaller.install()

    def crawl(self):
        driver = webdriver.Chrome()
        driver.get(self.url)
        self._open_seat_map(driver)

        self.page_source = driver.page_source

        driver.quit()

        return self.page_source

    def _open_seat_map(self, driver):
        seats_link = driver.find_elements(
            By.XPATH, "//*[text()=' نقشه صندلی‌ها']")

        for seat_link in seats_link:
            seat_link.click()

        time.sleep(10)
