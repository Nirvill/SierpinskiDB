#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

#define MAX_LINE_LENGTH 2048

typedef struct {
    char ip[16];
    char timestamp[64];
    char method[16];
    char url[256];
    char status[8];
    char size[16];
    char browser[512];
} LogEntry;

void timeconf(char *timestamp) {
    char month[4];
    char day[3];
    char year[5];
    char time[9];
    char timezone[6];
    char uniform[64];
    

    if (strchr(timestamp, '/') && strchr(timestamp, ':')) {
        if (sscanf(timestamp, "%2[^/]/%3[^/]/%4[^:]:%8[^ ] %5s", day, month, year, time, timezone) == 5) {
            char *months[] = {"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"};
            int month_num = 1;
            for (int i = 0; i < 12; i++) {
                if (strcmp(month, months[i]) == 0) {
                    month_num = i + 1;
                    break;
                }
            }
            snprintf(uniform, sizeof(uniform), "%s-%02d-%s %s", year, month_num, day, time);
            strcpy(timestamp, uniform);
        }
    }
    else if (strlen(timestamp) > 20 && isalpha(timestamp[0])) {
        char weekday[4];
        char month[4];
        char day[3];
        char time_with_ms[16];
        char year[5];
        
        if (sscanf(timestamp, "%3s %3s %2s %15s %4s", weekday, month, day, time_with_ms, year) == 5) {
            char time_only[9];
            strncpy(time_only, time_with_ms, 8);

            time_only[8] = '\0';
            
            char *months[] = {"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"};
            int month_num = 1;
            for (int i = 0; i < 12; i++) {
                if (strcmp(month, months[i]) == 0) {
                    month_num = i + 1;
                    break;
                }
            }
            
            snprintf(uniform, sizeof(uniform), "%s-%02d-%s %s", year, month_num, day, time_only);
            strcpy(timestamp, uniform);

        }
    }
}

int acclogpars(const char *line, LogEntry *entry) {

    memset(entry, 0, sizeof(LogEntry));
    
    const char *p = line;

    int i = 0;
    while (*p && !isspace(*p) && i < 15) {
        entry->ip[i++] = *p++;
    }
    entry->ip[i] = '\0';
    
    while (*p && *p != '[') p++;
    if (*p == '[') p++;
    
    i = 0;
    while (*p && *p != ']' && i < 63) {
        entry->timestamp[i++] = *p++;
    }
    entry->timestamp[i] = '\0';
    
    timeconf(entry->timestamp);
    
    while (*p && *p != '\"') p++;
    if (*p == '\"') p++;
    
    i = 0;
    while (*p && !isspace(*p) && i < 15) {
        entry->method[i++] = *p++;
    }
    entry->method[i] = '\0';
    
    while (*p && isspace(*p)) p++;
    i = 0;
    while (*p && !isspace(*p) && i < 255) {
        entry->url[i++] = *p++;
    }
    entry->url[i] = '\0';
    

    while (*p && *p != '\"') p++;
    if (*p == '\"') p++;
    while (*p && isspace(*p)) p++;
    
    i = 0;
    while (*p && !isspace(*p) && i < 7) {
        entry->status[i++] = *p++;
    }
    entry->status[i] = '\0';
    
    const char *last_space = NULL;
    const char *end = p + strlen(p);
    while (end > p) {
        if (isspace(*end)) {
            last_space = end;
            break;
        }
        end--;
    }
    
    if (last_space) {
        const char *size_start = last_space + 1;
        while (*size_start && isspace(*size_start)) size_start++;
        
        i = 0;
        while (*size_start && !isspace(*size_start) && i < 15) {
            entry->size[i++] = *size_start++;
        }
        entry->size[i] = '\0';
    } else {
        strcpy(entry->size, "0");
    }
    //nullvalue
    strcpy(entry->browser, "N/A");
    
    return 0;
}

int errlogpars(const char *line, LogEntry *entry) {

    memset(entry, 0, sizeof(LogEntry));
    
    strcpy(entry->method, "ERROR");
    strcpy(entry->url, "N/A");
    strcpy(entry->status, "500");
    strcpy(entry->size, "0");

    const char *p = line;
    if (*p == '[') p++;
    
    int i = 0;
    while (*p && *p != ']' && i < 63) {
        entry->timestamp[i++] = *p++;
    }
    entry->timestamp[i] = '\0';
    
    timeconf(entry->timestamp);
    
 //trying to extract ip
    const char *client_start = strstr(line, "[client ");
    if (client_start) {
        client_start += 8;

        const char *client_end = strchr(client_start, ']');
        if (client_end) {
            const char *ip_end = strchr(client_start, ':');

            if (ip_end && ip_end < client_end) {
                i = 0;
                while (client_start < ip_end && i < 15) {
                    entry->ip[i++] = *client_start++;
                }
                entry->ip[i] = '\0';
            } else {
                i = 0;
                while (client_start < client_end && i < 15) {
                    entry->ip[i++] = *client_start++;
                }
                entry->ip[i] = '\0';


            }
        }
    }
    if (strlen(entry->ip) == 0) {
        strcpy(entry->ip, "Unknown");
    }
    
    strncpy(entry->browser, line, sizeof(entry->browser) - 1);
    entry->browser[sizeof(entry->browser) - 1] = '\0';
    
    return 0;
}

//extracting for csv
void escape_csv_field(char *field, size_t max_len) {
    if (strchr(field, ',') != NULL || strchr(field, '"') != NULL || strchr(field, '\n') != NULL) {
        char temp[1024];
        char *src = field;
        char *dst = temp;
        *dst++ = '"';
        while (*src && (dst - temp) < (int)sizeof(temp) - 3) {
            if (*src == '"') {
                *dst++ = '"';
                *dst++ = '"';
            } else {
                *dst++ = *src;
            }
            src++;
        }
        *dst++ = '"';
        *dst = '\0';
        strncpy(field, temp, max_len - 1);
        field[max_len - 1] = '\0';
    }
}

int main(int argc, char *argv[]) {
    FILE *accfl, *errfil;
    char line[MAX_LINE_LENGTH];
    LogEntry entry;
    const char *search_term = "rzherebilo";
    
    accfl = fopen("/var/log/apache2/access_log", "r");
    errfil = fopen("/var/log/apache2/error_log", "r");
    
    if (accfl == NULL && errfil == NULL) {
        fprintf(stderr, "Error: Could not open log files\n");
        return 1;
    }
    

    printf("IP,Timestamp,Method,URL,Status,Size,Browser\n"); //init csv
    
    if (accfl != NULL) {
        while (fgets(line, sizeof(line), accfl) != NULL) {

            line[strcspn(line, "\n")] = 0;
            
            if (strstr(line, search_term) != NULL) {
                if (acclogpars(line, &entry) == 0) {
                    escape_csv_field(entry.ip, sizeof(entry.ip));
                    escape_csv_field(entry.timestamp, sizeof(entry.timestamp));
                    escape_csv_field(entry.method, sizeof(entry.method));
                    escape_csv_field(entry.url, sizeof(entry.url));
                    escape_csv_field(entry.status, sizeof(entry.status));
                    escape_csv_field(entry.size, sizeof(entry.size));
                    escape_csv_field(entry.browser, sizeof(entry.browser));
                    
                    printf("%s,%s,%s,%s,%s,%s,%s\n", 
                           entry.ip, entry.timestamp, entry.method, 
                           entry.url, entry.status, entry.size, entry.browser);
                }
            }
        }
        fclose(accfl);
    }
    
    
    if (errfil != NULL) {
        while (fgets(line, sizeof(line), errfil) != NULL) {
            line[strcspn(line, "\n")] = 0;
            
            if (strstr(line, search_term) != NULL) {
                if (errlogpars(line, &entry) == 0) {
                    escape_csv_field(entry.ip, sizeof(entry.ip));
                    escape_csv_field(entry.timestamp, sizeof(entry.timestamp));
                    escape_csv_field(entry.method, sizeof(entry.method));
                    escape_csv_field(entry.url, sizeof(entry.url));
                    escape_csv_field(entry.status, sizeof(entry.status));
                    escape_csv_field(entry.size, sizeof(entry.size));
                    escape_csv_field(entry.browser, sizeof(entry.browser));
                    
                    printf("%s,%s,%s,%s,%s,%s,%s\n", 
                           entry.ip, entry.timestamp, entry.method, 
                           entry.url, entry.status, entry.size, entry.browser);
                }
            }
        }
        fclose(errfil);
    }
    
    return 0;
}