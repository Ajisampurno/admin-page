
<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" md="12">
                <CardGroup />
            </v-col>
        </v-row>
    </v-container>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" md="8" sm="12">
                <v-card elevation="3" title="Line Chart">
                    <LineChart />
                </v-card>
            </v-col>
            <v-col cols="12" md="4" sm="12">
                <v-card elevation="3" title="Donut Chart">
                    <DonutChart />
                </v-card>
                <v-card elevation="3" title="Bar Chart" class="mt-2">
                    <BarChart />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
